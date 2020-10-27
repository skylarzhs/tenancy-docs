---
title: 具体的租户配置
extends: _layouts.documentation
section: content
---

# 租户配置 {#tenant-config}

你或许需要在你的应用程序中为租户特定配置，配置是API keys的形式，比如"每页产品(译注：每页产品的分页大小配置)"等等。
It's likely you will need to use tenant-specific config in your application. That config could be API keys, things like "products per page" and many other things.

你可以使用租户模型去获取这些值，但是你可能仍然想要使用 Laravel 的 `config()`去读取，因为：
You could just use the tenant model to get these values, but you may still want to use Laravel's `config()` because of:

- 关注点分离 —— 假如你只写与租恁实现无关`config('shop.products_per_page')`，你将有更多的时间去改变租恁实现。
- separation of concerns — if you just write tenancy implementation-agnostic `config('shop.products_per_page')`, you will have a much better time changing tenancy implementations
- 默认值 —— 你可能只想要用这个租户存储(storage)去覆盖你配置文件中的值
- default values — you may want to use the tenant storage only to override values in your config file

## **开启这个特性** {#enabling-the-feature}

取消 `tenancy.features`配置文件中下面这行的注释:

```php
// Stancl\Tenancy\Features\TenantConfig::class,
```

## **配置映射** {#configuring-the-mappings}
该特性将租户存储中的键映射到基于 `$storageToConfigMap` 公共属性的配置键上。
This feature maps keys in the tenant storage to config keys based on the `$storageToConfigMap` public property.

例如，如果你`$storageToConfigMap`看起来像这样：
For example, if your `$storageToConfigMap` looked like this:

```php
\Stancl\Tenancy\Features\TenantConfig::$storageToConfigMap = [
    'paypal_api_key' => 'services.paypal.api_key',
],
```

当租户初始化后，在租户模型中的这个`paypal_api_key`值会被复制到`services.paypal.api_key`配置中。
the value of `paypal_api_key` in tenant model would be copied to the `services.paypal.api_key` config when tenancy is initialized.

## 映射这个值到多个配置键上 {#mapping-the-value-to-multiple-config-keys}
## Mapping the value to multiple config keys {#mapping-the-value-to-multiple-config-keys}

有时你可能想要复制这个值到多个配置键上，为此，将配置键指定为数组：
Sometimes you may want to copy the value to multiple config keys. To do that, specify the config keys as an array:

```php
\Stancl\Tenancy\Features\TenantConfig::$storageToConfigMap = [
    'locale' => [
        'app.locale',
        'locales.default',
    ],
],
```
