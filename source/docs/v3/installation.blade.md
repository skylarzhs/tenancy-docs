---
title: 安装
extends: _layouts.documentation
section: content
---

# 安装 {#installation}

使用 composer 来安装:

```php
composer require stancl/tenancy
```

然后运行下面的命令:

```php
php artisan tenancy:install
```

它将会创建:

- 迁移文件
- 一个配置文件 (`config/tenancy.php`),
- 一个路由文件 (`routes/tenant.php`),
- 一个服务提供者文件 `app/Providers/TenancyServiceProvider.php`

然后在 `config/app.php` 文件中添加服务提供者:

```php
/*
 * Application Service Providers...
 */
App\Providers\AppServiceProvider::class,
App\Providers\AuthServiceProvider::class,
// App\Providers\BroadcastServiceProvider::class,
App\Providers\EventServiceProvider::class,
App\Providers\RouteServiceProvider::class,
App\Providers\TenancyServiceProvider::class, // <-- here
```

最后, 命名你的中心数据库连接 (in `config/database.php`) 为`central` 或任何你想要的名字, 但需要确保它与 `tenancy.central_connection` 配置文件中的名字一样。
