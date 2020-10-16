---
title: 域名
extends: _layouts.documentation
section: content
---

# 域名 {#domains}

注意: 域名是可选的，如果你使用路径(path)或请求数据(request data)来识别租户可无视本节。

通过域名去添加租户，应该用`domains`关联：

```php
$tenant->domains()->create([
    'domain' => 'acme',
]);
```

如果你使用子域名识别中间件，只需要将上面的例子`acme`改成`acme.{你的任何域名}`（译注：acme应该理解为任意的英文字符，比如zhangsan,lisi，wangermazi等），如果你使用域名识别中间件，应该使用完整的域名（如`acme.com`），
如果你既使用子域名识别中间件又使用域名识别中间件，那么填`acme`当子域名处理，而填写 `acme.com`将会当域名处理。

你可以在`DomainTenantResolver`上通过访问`$currentDomain`公共的静态方法获取检索（retrieve）当前域模型(在使用域名标识时)。

## 本地开发 {#local-development}

在本地开发时，你可以给租户使用`*.localhost` 域名（如 `foo.localhost`），在大多数操作系统上`localhost`工作方式都是相同的。

I如果你使用 Valet，你可能想要使用`saas.test` 作为中心域名，使用 `foo.saas.test`，`bar.saas.test` 等作为租户域名。
