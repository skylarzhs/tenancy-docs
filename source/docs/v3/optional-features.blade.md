---
title: 可选特征
extends: _layouts.documentation
section: content
---

# 可选特征 {#optional-features}

"特征"是一个提供附加功能的类，它在核心租户逻辑中不是必须的，这个包附带了这几个特征：

- [`UserImpersonation`]({{ $page->link('features/user-impersonation') }}) 为了能在某个租户环境（或中心环境）中，为了让用户访问另一个租户的数据库，生成一个模仿的 token。
- [`TelescopeTags`]({{ $page->link('features/telescope-tags') }}) 为了添加使用当前租户的ID作为标记去限制范围（Telescope entries）。
- [`TenantConfig`]({{ $page->link('features/tenant-config') }}) 为了将租户储存映射到应用程序配置。
- [`CrossDomainRedirect`]({{ $page->link('features/cross-domain-redirect') }})为在 `RedirectResponse` 上添加一个 `domain()` 宏，允许你改变这个生成路由的域名。
- [`UniversalRoutes`]({{ $page->link('features/universal-routes') }}) 为了一些可同时在租户/中心环境中访问的路由动作。
这个包的所有特性是在 `Stancl\Tenancy\Features` 命名空间中。

你可以在`tenancy.features`配置中通过添加它们的类名来注册这些特性。

