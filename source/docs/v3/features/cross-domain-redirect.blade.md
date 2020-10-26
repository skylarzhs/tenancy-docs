---
title: 跨域重定向
extends: _layouts.documentation
section: content
---

# 跨域重定向 {#cross-domain-redirect}

要开启这个特性, 在`tenancy.features`配置中取消`Stancl\Tenancy\Features\CrossDomainRedirect::class` 这行的注释。

有时候你可能希望将用户重定向到一个不同域名（相当于当前域名）上的特殊的路由。例如你希望用户在注册后重定向到一个租户的`home`路径。

```php
return redirect()->route('home')->domain($domain);
```
你还能用`tenant_route()` 辅助方法将用户重定向到另一个域名。

```php
return redirect(tenant_route($domain, 'home'));
```
