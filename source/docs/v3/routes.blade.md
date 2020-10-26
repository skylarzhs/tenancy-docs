---
title: 路由
extends: _layouts.documentation
section: content
---

# 路由 {#routes}

这个包包含了中心路由和租户路由的概念，中心路由仅在中心域名下可用，租户路由仅在租户域名下可用，如果你不使用域名识别，那么所有的路由都是可用的，你可以跳过防止其他域访问的细节的这节。

## 中心路由 {#central-routes}

就像你习惯的那样可以在`routes/web.php` 或 `routes/api.php`中注册中心路由，但需要在 RouteServiceProvider 里做一点小的改动。

你不在用中心路由时候，想想在登录页和注册页（译注：属于中心路由和租户路由之间），它们在租户域名下被访问，出于这个原因（译注：不希望在租户域名下访问登录或注册页），按下面这种方式注册路由，那样只能在中心域名上访问它们了:

```php
// RouteServiceProvider

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
    return config('tenancy.central_domains', []);
}
```

注意：如果你使用多个中心域名，就不能使用路由名，因为不同的路由（即不同的域名与路径的组合）不能共享同一个名字，如果你想要测试使用一个不同的中心域名，在你的测试用例 `setUp()`中使用 `config()->set()` 。

## 租户路由 {#tenant-routes}

你可以在`routes/tenant.php`注册租户路由，这些路由是没有中间件的，并且它们的控制器命名空间被指定在`app/Providers/TenancyServiceProvider`中。

默认情况下，你将看到下面的设置：

```php
Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return '这是你的中心应用程序，当前的租户ID是 ' . tenant('id');
    });
});
```
在路由中有一个`web`中间件组，是一个初始化中间件，后面的章节会使用到它们。

在`api`路由组中也是一样的，例如：

此外，你可以为每个域名使用不同的初始化中间件，详细请看  [租户识别]({{ $page->link('tenant-identification') }}) 页面。

### 路径冲突 {#conflicting-paths}

由于服务提供者(以及它们的路由)的注册顺序，租户路由将优先于中心路由。租户路由将优先于中心路由，因此，如果在`routes/web.php`文件和`routes/tenant.php`文件中都有一个`/` 路由，那么这个路由会在租户域名下生效。

然而，从中心路由访问这个路由，将会报"无法在域名中识别租户"的错误，为了避免这种情况，在租户路由上使用`Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains`中间件，它将会忽略404错误（如果试图在中心域名上去访问租户路由）。

## 通用路由 {#universal-routes}

参见 [通用路由特性]({{ $page->link('features/universal-routes') }}).
