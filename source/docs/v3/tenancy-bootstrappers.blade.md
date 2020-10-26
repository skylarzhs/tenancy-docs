---
title: 租恁引导器
extends: _layouts.documentation
section: content
---

# 租恁引导器 {#tenancy-bootstrappers}

租赁引导器是一个使应用程序能够识别租户的类，这样您就不需要更改一行代码，就会将所有的范围限定到当前租户。

这个包已经附带了这些引导器：

## 数据库租恁引导器 {#database-tenancy-bootstrapper}

数据库租恁引导器在租户构建连接(译创建租户)后，将 **默认** 数据库切换到到`tenant`。

[自定义数据库]({{ $page->link('customizing-databases') }})

注意，那仅是 **默认** 数据库连接被切换了。如果明确的使用另一个数据库连接，当使用`DB::connection('...')`，使用模型方法`getConnectionName()`或在模型中 trait 如 `CentralConnection`，这些都是 **不会改变连接的** ，这个引导器不会 **强制** 任何连接，它仅仅会改变默认连接。

## 缓存租恁引导器 {#cache-tenancy-bootstrapper}

缓存租恁引导器会用一个自定义缓存管理器去替换 Laravel 的缓存管理器实例，这个自定义缓存管理器在缓存被调用时，为缓存添加当前租户的id标记。

```php
php artisan cache:clear --tag=tenant_123
```

注意，你必须使用支持标记的缓存存储，如：Redis。

## 文件系统租恁引导器 {#filesystem-tenancy-boostrapper}

这个引导器会干以下几件事情：

- 使用`Storage`门面时候添加后缀。
- `storage_path()`后缀（如果使用本地磁盘来存储租户数据是有用的）
- 让 `asset()` 用 TenantAssetController 去获取租户独有的数据（tenant-specific data）。
    - 注意：一些 assets，如：图片，你可能想要使用`global_asset()`（如果这个asset是所有租户共享的），并且  JS/CSS assets，你应该使用`mix()` 或又用 `global_asset()`

这个引导器是最复杂的一个，到目前为止，v3文档中还没有解释（很快就会有一个更好的文档），但是现在请参考2.x文档来了解文件系统租恁[https://tenancyforlaravel.com/docs/v2/filesystem-tenancy/](https://tenancyforlaravel.com/docs/v2/filesystem-tenancy/)。

如果您不想以这种方式引导文件系统租赁，比如为每个租户使用 S3 bucket，你可以那么做，去看下这个包的引导器部分，看怎样根据你的想法写一个自己的引导器，并且你可以用任何你想要的方式来实现它。

## 队列租恁引导器 {#queue-tenancy-bootstrapper}

这个引导器添加一个当前租户ID到队列任务中，当任务被执行后会根据租户ID来初始化租恁。

你能在 *队列*页阅读更多相关内容： 

[队列]({{ $page->link('queues') }})

## Redis 租恁引导器 {#redis-tenancy-bootstrapper}

如果你租户应用程序中使用`Redis`调用（不是 redis 缓存调用，是**直接** 用Redis靠用），你也想要限制 Redis 数据的范围，那么就要用这个引导器，它能为每个租户改变 Redis 的前缀。

注意你需要 phpredis，predis是不能用的。

## 自制一个引导器 {#writing-custom-bootstrappers}

如果你想为本包不涵盖的部分去实现租户引导，或者本包已涵盖，但你想要不同的行为，你可通过创建一个引导器类来实现这一点。

这个类必须要实现`Stancl\Tenancy\Contracts\TenancyBootstrapper`接口：

```php
namespace App;

use Stancl\Tenancy\Contracts\TenancyBootstrapper;
use Stancl\Tenancy\Contracts\Tenant;

class MyBootstrapper implements TenancyBootstrapper
{
    public function bootstrap(Tenant $tenant)
    {
        // ...
    }
	
    public function revert()
    {
        // ...
    }
}
```

然后，在`tenancy.bootstrappers`配置中注册：

```php
'bootstrappers' => [
    Stancl\Tenancy\Bootstrappers\DatabaseTenancyBootstrapper::class,
    Stancl\Tenancy\Bootstrappers\CacheTenancyBootstrapper::class,
    Stancl\Tenancy\Bootstrappers\FilesystemTenancyBootstrapper::class,
    Stancl\Tenancy\Bootstrappers\QueueTenancyBootstrapper::class,

    App\MyBootstrapper::class,
],
```
