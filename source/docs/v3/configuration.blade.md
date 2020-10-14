---
title: 配置
extends: _layouts.documentation
section: content
---

# 配置  {#configuration}

这包具有高可配置性。 这个涵盖了在 `config/tenancy.php` 文件中可配置的内容， 但请注意很多东西是可以配置的。一些是可以通过继承类来改变的 (如： `Tenant` 模型)，以及 **许多** 可以通过静态属性来改变。 这些将会 *通常* 在文档个各个页面会提及， 但不会每次都提及。因为这个原因，别害怕深入了解包的源代码 
—— 无论何时你的类使用了一个`public static` 属性, **这是有意用来配置的**。

## 静态属性 {#static-properties}

你可以像这样设置静态属性 (例子):

```php
\Stancl\Tenancy\Middleware\InitializeTenancyByDomain::$onFail = function () {
    return redirect('https://my-central-domain.com/');
};
```

把这些调用放到 `app/Providers/TenancyServiceProvider` 文件中 `boot()` 方法里是一个不错的地方。

### 租户模型 {#tenant-model}

`tenancy.tenant_model`
这个配置指定哪一个 `Tenant` 模型通过这个包应该被使用。你很可能使用自定义模型，正如在 [租户]({{ $page->link('tenants') }}) 页面所指示的那样， 因此一定要在配置文件中修改它。

### 唯一 ID 生成器 {#unique-id-generator}

`tenancy.id_generator`

这个 `Stancl\Tenancy\Database\Concerns\GeneratesIds` trait, 它会被应用到默认的 `Tenant` 模型上, 如果没有用到租户 id 的话，那么将生成一个唯一 ID (默认使用uuid) 。

如果你希望使用自动递增的 ids 来代替 uuids:

1. 设置这个配置 key 为 null，或创建一个自定义租户模型，那样就不会使用这个 trait 了。
2. 更新这个 `tenants` 表迁移去使用自增字段类型代替 `string` 类型。

### 域名模型 {#domain-model}

`tenancy.domain_model`

类似与租户模型的配置。如果你为域名使用一个自定义模型，在配置文件中修改它。如果你不再用域名（例如 如果你使用 path 和请求内容来识别），你完全可以忽略这个key。

### 中心域名 {#central-domains}

`tenancy.central_domains`

在访问你的域名 [central app]({{ $page->link('the-two-applications') }})时，会用到下面两个中间件 :

- `PreventAccessFromCentralDomains` 中间件, 防止从中心域访问租户路由。
- `InitializeTenancyBySubdomain` 中间件, 检查当前域名是否为你的中心域名上的子域名。

### Bootstrappers {#bootstrappers}

`tenancy.bootstrappers`

这个配置数组让你允许、禁止或添加您自己的[tenancy bootstrappers]({{ $page->link('tenancy-bootstrappers') }})。

### 数据库 {#database}

`tenancy.database.*`

本节与多数据库租用相关，特别是`DatabaseTenancyBootstrapper` 以及管理租户数据库逻辑。

请参阅配置中的此部分，它是有注释说明的。

### 缓存 {#cache}

`tenancy.cache.*`
这节是关于缓存隔离的，特别是`CacheTenancyBootstrapper`

注意: 使用缓存隔离，你需要使用一个能提供标记的缓存存储，通常使用 Redis。

查看配置文件中的这一段，有注释说明。


### 文件系统 {#filesystem}

`tenancy.filesystem.*`

这节是关于文件系统的，特别是 `FilesystemTenancyBootstrapper`.

查看配置文件中的这一段，有注释说明。

### Redis {#redis}

`tenancy.redis.*`

这节是关于 Redis 数据分割，特别是 `RedisTenancyBootstrapper`。

注意：使用启动加载器（bootstrapper），你需要 phpredis。

See this section in the config, it's documented with comments.

### 特性 {#features}

`tenancy.features`

这个配置文件允许、禁止或添加你自己的 [feature classes]({{ $page->link('optional-features') }}).

### 迁移参数 {#migration-parameters}

`tenancy.migration_parameters`

当你运行 `tenants:migrate`命令（或这个命令通过`MigrateDatabase`任务被执行时），这个配置数组能让你设置一些参数。当然，所有这些参数都可以通过在命令调用中直接传递来覆盖它，无论是在 CLT 还是使用`Artisan::call()`。

### Seeder 参数 {#seeder-parameters}

`tenancy.seeder_parameters`

跟迁移参数相同，but for tenants:seed and the SeedDatabase job。

