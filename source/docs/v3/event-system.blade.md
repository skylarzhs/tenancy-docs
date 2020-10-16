---
title: 事件系统
extends: _layouts.documentation
section: content
---


# 事件系统 {#event-system}

这个包在很大程度上是基于事件的，这使得它非常灵活。

默认情况下，配置好事件后的工作方式如下:

- 对于从租户路上过来的请求会触发一个租户识别中间件。
- 这个识别中间件会找到正确的租户并运行。

```php
$this->tenancy->initialize($tenant);
```

-  `Stancl\Tenancy\Tenancy` 类通过设置 `$tenant` 为当前租户并且触发一个 `TenancyInitialized` 事件。
-  `BootstrapTenancy` 类会捕获这个事件并执行这个前面提到的（已知）[租户引导器（tenancy bootstrappers）]({{ $page->link('tenancy-bootstrappers') }}).
- 这个租户引导器会限制应用程序仅在当前租户范围中，这个默认设置包括:
    - 切换数据库连接
    - 替换 `CacheManager`的缓存管理范围
    - 在文件系统路径增加后缀
    - 使用队列存储租户id，当队列开始执行的时会初始化租户


同样，上面这些所有的配置都是可以不用租户引导器，仅使用租户识别并在`Stancl\Tenancy\Tenancy`中手动限制你的app的租户范围，怎么用选择权在你。

# TenancyServiceProvider {#tenancyserviceprovider}

这个包附带了一个非常方便的服务提供者（它在安装这个包时就添加到你应用程序中），这个服务提供者被用于侦听这包的具体事件，你应该将它放在一个特别的租户服务容器中调用 （tenancy-specific service container，译注：就是单独弄一个XXXServiceProvider方便管理，而不去污染你的 AppServiceProvider）。

注意，你能在**任何地方**注册侦听这个包的的事件，把事件/侦听者对应关系放在这个服务提供这里可以让你的工作更轻松。如果你想要手动注册这个侦听器，请参考如下：

```php
Event::listen(TenancyInitialized::class, BootstrapTenancy::class);
```

# 引导租恁 {#bootstrapping-tenancy}

默认情况下, 这个 `BootstrapTenancy` 类会侦听 `TenancyInitialized` 事件 (正如你在上面的例子中看到的那样)，该侦听器将执行已配置的租恁引导器，以将应用程序转换到租户的环境（上下文）中。了解更多 [租恁引导器]({{ $page->link('tenancy-bootstrappers') }}) page.

相反的, 当`TenancyEnded` 事件被触发, 这个 `RevertToCentralContext` 事件会将app切换回中心环境（中心上下文里）。

# 任务管道 {#job-pipelines}

即使在不使用此包的项目中，也可能希望使用任务管道，我认为这是一个很不错的观念，因此它们被提取到了一个独立的包：[github.com/stancl/jobpipeline](https://github.com/stancl/jobpipeline)

这 `JobPipeline` 是很简单但 **非常强大的** 类， 让你**将任何(连续)的任务转换为事件侦听器。

你可以像其他侦听器那样使用任务管道，因此你可以在`TenancyServiceProvider`中注册，至于在`EventServiceProvider`使用 `$listen` 数组，还是在其他任何地方使用 `Event::listen()`，这由你决定。

## 创建任务管道 {creating-job-pipelines}

要创建任务管道，先从指定一个任务开始：

```php
use Stancl\JobPipeline\JobPipeline;
use Stancl\Tenancy\Jobs\{CreateDatabase, MigrateDatabase, SeedDatabase};

JobPipeline::make([
    CreateDatabase::class,
    MigrateDatabase::class,
    SeedDatabase::class,
])
```

然后，指定要传给这个任务的变量，这通常来自于事件。

```php
use Stancl\JobPipeline\JobPipeline;
use Stancl\Tenancy\Jobs\{CreateDatabase, MigrateDatabase, SeedDatabase};
use Stancl\Tenancy\Events\TenantCreated;

JobPipeline::make([
    CreateDatabase::class,
    MigrateDatabase::class,
    SeedDatabase::class,
])->send(function (TenantCreated $event) {
    return $event->tenant;
})
```

下一步，决定是否要将管道排队（译注：顺序执行），默认情况下管道是同步的（即不排队）。

如果您**确实**希望管道在默认情况下排队，你可以通过设置一个静态属性来实现：
`\Stancl\JobPipeline\JobPipeline::$shouldBeQueuedByDefault = true;`

```php
use Stancl\Tenancy\Events\TenantCreated;
use Stancl\JobPipeline\JobPipeline;
use Stancl\Tenancy\Jobs\{CreateDatabase, MigrateDatabase, SeedDatabase};

JobPipeline::make([
    CreateDatabase::class,
    MigrateDatabase::class,
    SeedDatabase::class,
])->send(function (TenantCreated $event) {
    return $event->tenant;
})->shouldBeQueued(true),
```

最后，转换这个管道为侦听器并绑定一个事件：

```php
use Stancl\Tenancy\Events\TenantCreated;
use Stancl\JobPipeline\JobPipeline;
use Stancl\Tenancy\Jobs\{CreateDatabase, MigrateDatabase, SeedDatabase};
use Illuminate\Support\Facades\Event;

Event::listen(TenantCreated::class, JobPipeline::make([
    CreateDatabase::class,
    MigrateDatabase::class,
    SeedDatabase::class,
])->send(function (TenantCreated $event) {
    return $event->tenant;
})->shouldBeQueued(true)->toListener());
```
要注意，你可以将任务管道甚至单个的任务转换为侦听器，如果您在任务类中有一些逻辑，并且不希望创建侦听器类只是为了在触发事件时能够运行这些任务，那么这将非常有用。

# 可用的事件 {#available-events}

注意: 一些数据库事件 (`DatabaseMigrated`, `DatabaseSeeded`, `DatabaseRolledback` 和可能的其他事件) 是 **在租户环境中触发** 这取决于应用程序引导租赁的方式, 如果需要的话，你可能有需要具体指出如何在这些事件的侦听器中与中央数据库交互。

注意: 所有的事件都处于 `Stancl\Tenancy\Events` 命名空间中。

### **租恁** {#tenancy}

- `InitializingTenancy`
- `TenancyInitialized`
- `EndingTenancy`
- `TenancyEnded`
- `BootstrappingTenancy`
- `TenancyBootstrapped`
- `RevertingToCentralContext`
- `RevertedToCentralContext`

注意*初始化租恁与引导租恁*的区别，当租户被加载到`Tenancy`对象中时,完成租恁初始化，然而引导是初始化的结果，
如果你使用的自动租恁模式，`BootstrapTenancy` 类是侦听`TenancyInitialized` 事件并且在侦听后执行引导器，它触发一个事件表示租恁被引导了（译注：先触发初始化事件`TenancyInitialized`再触发`BootstrapTenancy`事件），
如果希望在应用程序转换到租户环境后执行某些操作，则需要使用引导事件。

### 租户 {#tenant}

由于默认实现了`Tenant`，那么在 Eloquent 事件被触发的时下面这些事件会被调用。(常用的用粗体表示):

- `CreatingTenant`
- **`TenantCreated`**
- `SavingTenant`
- `TenantSaved`
- `UpdatingTenant`
- `TenantUpdated`
- `DeletingTenant`
- **`TenantDeleted`**

### 域名 {#domain}

这些事件是可选的， 只有当你为你的租户使用域名时，它们才与你相关.

- `CreatingDomain`
- **`DomainCreated`**
- `SavingDomain`
- `DomainSaved`
- `UpdatingDomain`
- `DomainUpdated`
- `DeletingDomain`
- **`DomainDeleted`**

### 数据库 {#database}

这些事件也是可选的，只有当你使用多数据库租恁方式时，它们才与你相关：

- `CreatingDatabase`
- **`DatabaseCreated`**
- `MigratingDatabase`
- `DatabaseMigrated`
- `SeedingDatabase`
- `DatabaseSeeded`
- `RollingBackDatabase`
- `DatabaseRolledBack`
- `DeletingDatabase`
- **`DatabaseDeleted`**

### 资源同步 {#resource-syncing}

- **`SyncedResourceSaved`**
- `SyncedResourceChangedInForeignDatabase`
