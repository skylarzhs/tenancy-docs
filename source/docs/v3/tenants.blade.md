---
title: 租户
extends: _layouts.documentation
section: content
---

# 租户 {#tenants}

租户就是一个实现了`Stancl\Tenancy\Contracts\Tenant`接口的任何模型。

这个包为常见的应用附带了一个基础的`Tenant`模型，虽然在大多数情况下需要扩展它，因为它有点呆板（ it attempts not to be too opinionated）。

这个基础模型包含的必要接口的功能有:

- 强制中心连接 (可让你在租户模型甚至在租户环境中进行交互)
- 数据列 trait —— 让你存储专有Keys， trait 出`data`列，租户模型中没有自己列的属性将存储在`data` JSON列中。
- Id 生成 trait — 当你没有提供 ID, 将生成一个随机的 uuid ， 如果你希望使用数字ids，还有一个替代方法是使用自增列， 修改 `create_tenants_table` 迁移，使用 `bigIncrements()` 或其他列类型, 并且设置 `tenancy.id_generator` 配置为 null，那将完全禁止 id 生成, 从而使用数据库自增机制。

**大多数** 应用程序使用这个包想要 域名/子域名进行租户识别以及（独立的）租户数据库 。

首先，创建一个新的模型，例如`App\Tenant`，看起来如：

```php
<?php

namespace App;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;
}
```

然后， 要使用这个模型,还需在 `config/tenancy.php`配置:

```php
'tenant_model' => \App\Tenant::class,
```

如果你想要自定义`Domain`模型，你也能那么做。`

**如果你不需要域名或数据库可忽略上面的步骤.** 仍然会正常运行。

## 创建租户 {#creating-tenants}

你可以像其他模型那样创建租户:

```php
$tenant = Tenant::create([
    'plan' => 'free',
]);
```

在租户创建后就会出发一个事件，那些被监听的事件都触发，如数据库被创建和执行迁移等。

## 自定义列 {#custom-columns}

租户模型中没有自己列的属性将存储在`data` JSON列中。

你可以在你的`Tenant`模型定义自定义去覆盖`getCustomColumns()`方法。
```php
public static function getCustomColumns(): array
{
    return [
        'id',
        'plan',
        'locale',
    ];
}
```
**注意不要忘记了把`id`放在自定义列（columns）中**

如果你要重命名`data`字段，在迁移文件中重命名并在你的模型中实现这个方法。

```php
public static function getDataColumn(): string
{
    return 'my-data-column';
}
```
注意：在`data`列中使用`where()`语句查询，参考下面的例子：
```php
where('data.foo', 'bar')
```

数据列仅在模型读取和保存时进行编码/解码。

另外，有一个经验法则是当你使用`WHERE`查询子句查询时，它应该有个专用的字段名，这将会改进性能并不用去想`data.`前缀。

## 在租户环境中运行命令行 {#running-commands-in-the-tenant-context}

你可以在租户环境中通过运行命令（在租户模型中调用`run()`方法），会返回前一个环境（中心环境或另一个租户环境），例如：

```php
$tenant->run(function () {
    User::create(...);
});
```

## 内部键 {#internal-keys}

我们会在内部的健中使用前缀（默认是`tenancy`前缀，但你可以通过覆盖`internalPrefix()`自定义这个它），因此不要用这个前缀作为任何属性/列名的开头

## 事件 {#events}

`Tenant`模式会调度 Elooquent 事件，它们都有各自的类，了解更多可以去 [事件系统]({{ $page->link('event-system') }}) 页。

## 访问当前租户 {#accessing-the-current-tenant}

你可以使用 `tenant()` 帮助方法来访问当前租户，您还可以传递一个参数来从租户模型获取属性, 例如： `tenant('id')`。

抑或是, 你可以通过`Stancl\Tenancy\Contracts\Tenant`接口的类型提示使用服务容器注入到这个模型中。

## 自增 IDs {#incrementing-ids}

默认情况下, 迁移里的 `id` 列使用 `string` 类型，并且在创建租户之前当你不提供`id`列，模型就会 生成 UUID做为id。

如果你喜欢使用自增id，你可以覆盖`getIncrementing()`方法：

```php
public function getIncrementing()
{
    return true;
}
```
