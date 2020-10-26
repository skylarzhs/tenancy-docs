---
title: 用户模拟
extends: _layouts.documentation
section: content
---

# 用户模拟 {#user-impersonation}

这个包附带了一个让你模拟其他用户进入租户数据库的特性，这个特性适用于 **任何识别方法** 和 **任何授权看守器**，甚至使用了多个。

## 它是如何运作的？

你生成了一个模拟的 token 并在重新数据库上保存，存在 `tenant_user_impersonation_tokens` 表中。

表中的每条记录包含如下数据：

- Token的值（128长度字母字符串）
- 这个租户的id
- 这个用户的id
- 授权看守器的名称
- 模拟发生后要重定向的URL。

你访问一个你创建的模拟路由，虽然你这边不需要做什么工作，您的路由通常只会调用该特性提供的一个方法，这个路由如果是一个**租户路由**，这意味着如果你使用域名识别，它是在租户域名上，如果使用路径标识,则使用租户id作为前缀。

这个路由会尝试根据Token来找出一条记录，它使用存储的用户id对您进行身份验证，如果验证有效就重定向到存储的URL

如果模拟成功了，这个token将会从数据库中删除。

所有的token默认是60秒后过期，当然这个TTL能被自定义——参见本节的最下面。

## 开启这个特性

要开启这个特性，去`config/tenancy.php` 文件确保下面的类在你配置文件的`features`的部分：

```jsx
Stancl\Tenancy\Features\UserImpersonation::class,
```

接下来，发布创建模拟tokens的表的迁移。

```jsx
php artisan vendor:publish --tag=impersonation-migrations
```

最后，运行迁移：

```jsx
php artisan migrate
```

## 用法 {#usage}

首先，你必须要创建一个租户路由，就像这样：

```jsx
use Stancl\Tenancy\Features\UserImpersonation;

// 我们在您的租户路由中
// We're in your tenant routes!

Route::get('/impersonate/{token}', function ($token) {
    return UserImpersonation::makeResponse($token);
});

//当然，在生产环境中使用控制器而不使用闭包路由，
// 闭包路由不能被缓存。
// Of course use a controller in a production app and not a Closure route.
// Closure routes cannot be cached.
```

请注意,路由的路径或名称完全由您决定，这个包的唯一逻辑是生成token、验证token并且模拟用户登录。

要在你的应用程序中使用模拟，像下面这样生成一个token：

```jsx
//假设，我们在以模拟用户登录后，我们想要重定向到 dashboard 
// Let's say we want to be redirected to the dashboard
// after we're logged in as the impersonated user.
$redirectUrl = '/dashboard';

$token = tenancy()->impersonate($tenant, $user->id, $redirectUrl);
```
并且将用户（多半是个"管理员"）重定向到你创建的路由。

### 域名识别 {#domain-identification}

```jsx
// 注意：这不是包的一部分，这取决于你实现"主域名"的概念，
// 也许你想为每一个租户是单独使用一个域名，这个包也能实现。
// Note: This is not part of the package, it's up to you to implement
// a concept of "primary domains" if you need them. Or maybe you use
// one domain per tenant. The package lets you do anything you want.

$domain = $tenant->primary_domain;
return redirect("https://$domain/impersonate/{$token->token}");
```

### 路径识别 {#path-identification}

```jsx
// 确保你的路由使用了正确的前缀
// Make sure you use the correct prefix for your routes.
//
return redirect("{$tenant->id}/impersonate/{$token->token}");
```
就是这样，这个用户将会被重定向到你的模拟路由，作为模拟用户登录，并且最终重定向到你的重定向URL上。

### 自定义授权看守器 {#custom-auth-guards}

如果你使用多重授权看守器，您可能需要指定模拟逻辑应该使用哪一个授权看守器。
If you're using multiple auth guards, you may want to specify what auth guard the impersonation logic should use.

为此，只需要将授权看守器名称作为第四个参数传递给`impersonate()`方法，我们开扩展一下上面的例子：

```jsx
tenancy()->impersonate($tenant, $user->id, $redirectUrl, 'jwt');
```

## 定制 {#customization}

通过设置下面的静态属性，你可以自定义模拟token的TTL（单位：秒）。

```jsx
Stancl\Tenancy\Features\UserImpersonation::$ttl = 120; // 2 minutes
```
