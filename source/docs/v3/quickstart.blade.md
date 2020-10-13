---
title: 快速入门教程
extends: _layouts.documentation
section: content
---

# 快速入门教程 {#quickstart-tutorial}

本教程主要介绍如何快速开始使用 stancl/tenancy 3.x ，它演示了多数据库租用和域名鉴别。如果你需要不同的例子，  用**这个包是完全可能的** 并且它非常容易的重构不同的实现。

我们建议您遵循本教程，这样你可以使用这个包来让程序跑起来。然后如果你有需要，你可以重构这个多租户的实现细节（例如：单数据库租用，请求数据识别等）。

## 安装 {#installation}

首先, 通过composer来安装这个包:

```php
composer require stancl/tenancy
```

然后, 执行 `tenancy:install` 命令:

```php
php artisan tenancy:install
```

这会创建几个文件: 迁移文件, 配置文件, 路由文件和服务提供者。

让我们执行迁移:

```php
php artisan migrate
```

在 `config/app.php`中注册这个服务提供者，确认把它放在下面这段代码片段中的相同位置上:

```php
/*
 * Application Service Providers...
 */
App\Providers\AppServiceProvider::class,
App\Providers\AuthServiceProvider::class,
// App\Providers\BroadcastServiceProvider::class,
App\Providers\EventServiceProvider::class,
App\Providers\RouteServiceProvider::class,
App\Providers\TenancyServiceProvider::class, // <-- here【这里】
```

## 创建一个租户模型 {#creating-a-tenant-model}

现在你需要创建一个租户模型(model)，虽然这个包自带了一个丰富特性的默认租户模型，但试图让它更灵活，我们需要创建一个自定义 model 来使用域名和数据库， 创建 `App\Tenant` 如:

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

Now we need to tell the package to use this custom model:
现在我们需要告诉这个包使用自定义模型:

```php
// config/tenancy.php

'tenant_model' => \App\Tenant::class,
```

## 事件 {#events}

这些默认设置开箱即用，但简短的解释更有用. 在你 `app/Providers` 目录下的`TenancyServiceProvider` 文件来侦听租用事件。 默认情况i啊, 当一个租户被创建, 它运行 `JobPipeline` (这个包里的一个非常小的功能) 来确信 `CreateDatabase`, `MigrateDatabase` 和其他可选项 (e.g. `SeedDatabase`) 会被依次执行。

换言之, 在 created 事件后它会创建和迁移租户的数据 ，并且按照正确的顺序来执行。因为常规的事件侦听器（event-listener）会按照某种愚蠢的顺序执行，比如在数据库创建之前就开始执行迁移，或者在迁移之前执行填充示例（seeded）。

## 中心路由 {#central-routes}

我们将在 `app/Providers/RouteServiceProvider.php` 文件中做一些小的改变，更具体地说是, 我们要确保中心路由（译注：不区分租户的路由）只在中心域名上被注册。

```php
protected function mapWebRoutes()
{
    foreach ($this->centralDomains() as $domain) {
        Route::middleware('web')
            ->domain($domain)
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }
}

protected function mapApiRoutes()
{
    foreach ($this->centralDomains() as $domain) {
        Route::prefix('api')
            ->domain($domain)
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}

protected function centralDomains(): array
{
    return config('tenancy.central_domains');
}
```

如果你使用 Laravel 8, 需要在 `RouteServiceProvider`的 `boot()` 方法中手动调用, 来替代 `$this->routes()` 调用。

```php
public function boot()
{
    $this->configureRateLimiting();

    $this->mapWebRoutes();
    $this->mapApiRoutes();
}
```

## 中心域名 {#central-domains}

现在我们需要来指定中心域名，中心域名是服务你"中心 app"的域名，例如：租户的登录页。打开 `config/tenancy.php` 文件并在里面添加:

```php
'central_domains' => [
    'saas.test', // Add the ones that you use. I use this one with Laravel Valet.
],
```

## 租户路由 {#tenant-routes}

默认情况下，你的租户路由看起来像这样的:

```php
Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });
});
```

这些路由仅能在租户域名（非中心域名）下访问 —— 由 `PreventAccessFromCentralDomains` 中间件强制实现。

让我们做一个小更改,将所有用户转储到数据库中, 这样我们就能看到多租户在运作了。

```php
Route::get('/', function () {
    dd(\App\User::all());
    return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
});
```

## 迁移 {#migrations}

要在租户数据库中拥有users表, 我们移动 `users` 表并迁移至 `database/migrations/tenant`下， 这将防止在中心数据库中被创建 —— 这得益于我们做了事件设置。

## 创建租户 {#creating-tenants}

出于测试目的, 我们将在 `tinker`中创建租户 —— 现在不需要浪费事件来创建控制器和试图。

```php
$ php artisan tinker
>>> $tenant1 = Tenant::create(['id' => 'foo']);
>>> $tenant1->domains()->create(['domain' => 'foo.localhost']);
>>>
>>> $tenant2 = Tenant::create(['id' => 'bar']);
>>> $tenant2->domains()->create(['domain' => 'bar.localhost']);
```

现在我们将为每一个租户（在租户数据库中）创建一个用户表:

```php
App\Tenant::all()->runForEach(function () {
    factory(App\User::class)->create();
});
```

如果你使用 Laravel 8, 这个命令有一些轻微的不同:

```php
App\Models\Tenant::all()->runForEach(function () {
    App\Models\User::factory()->create();
});
```

## 试试看 {#trying-it-out}

现在，在你浏览器里打开 `foo.localhost` ，我们应该能看到 users 表里的用户，打开 `bar.localhost`，我们将能看到一个不同的用户。
