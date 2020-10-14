---
title: 与其他包相比
extends: _layouts.documentation
section: content
---

# 与其他包相比 {#compared-to-other-packages}

## hyn/multi-tenancy {#hyn-multi-tenancy}

这个包意在为在你应用程序中**手动**添加多个租户而提供的一个必要工具。它将给你模型 traits、创建租户数据库的类和一些附加工具。

当您想手动实现多租户时，它是一个不错的选择，但是：

- 它不是一个在积极维护的包 —— 在过去一年内没有添加任何特性。
- 它让测试工作变成噩梦。

    在过去几个月里，我收到这样的反馈:

    > 但是, 我仍然不能在 Hyn 里运行任何测试，还有一些队列问题，我现在仍感到紧张。

    > 当时, 我们的应用使用最新 Laravel 和最新 hyn/tenancy，我唯一不喜欢它的地方是，测试非常脆弱，以至于我不敢乱动任何东西以免全部被破坏了。

    > 顺便说一下，这个包相当不错的! 它比hyn要好得多，在我看来hyn有点乱，真是相见恨晚呀。
    
    我分享这些不是故意说 hyn/multi-tenancy 很差，但是**如果你决定用那个包装的话，要非常小心**。

## tenancy/tenancy {#tenancy-tenancy}

这个包意在为你实现多租户提供一个框架， 文档相当匮乏， 因此我不太详细的了解它要做说明，但从我理解来看, 它提供事件之类的东西，您可以使用它们构建自己的多租户逻辑。

如果您希望获得足够的灵活性，并且希望构建自己的实现，那么研究这个包可能会很有用。

但是，如果你想要寻找一个能快速创建多租户项目的包，这可能不是一个好的选择。

## spatie/laravel-multitenancy {#tenacy-laravel-multitenancy}

这个包很简单的实现了多租户。

它与 stancl/tenancy v2 类似, 但是只有功能更少一些。

唯一的好处是我看到这个包与 stancl/tenancy v2 相比，它使用了开箱即用的 Eloquent ，那样会让集成收银台更加容易，但这无关紧要，我们在 v3 中使用了 Eloquent。

因此，我建议只有当您出于某种原因重视简单性，和不构建任何具有复杂性的东西，并且需要“业务特性”时，才考虑使用这个包。

## stancl/tenancy {#stancl-tenancy}

依我偏见（当然这个观点也几乎是事实）， 这个包是绝大多数应用的绝佳选择。

我实际上只会考虑用我的包（这是当然咯），如果你必须**非常**定制可以考虑 tenancy/tenancy包，尽管我在99%的应用中看不到这样的原因。

这个包努力做到像 tenancy/tenancy 那样灵活，而且还为您提供了大量的开箱即用特性和其他工具，它会以它的方式（最先使用自动方式添加许多的特性的包）继续下去 —— 在v3中，其中大多数是“企业版”特性。

为了给你足够好的功能，这个包提供：

- 多数据库租用
    - 创建数据库（译注：通过程序创建）
        - MySQL
        - PostgreSQL
        - PostgreSQL (schema mode)
        - SQLite
    - 创建数据库用户（译注：为数据库分配用户）
    - 自动切换数据库
    - CLI命令行, 还有比 spatie/laravel-multitenancy 多了很多的功能。
        - migrate
        - migrate:fresh
        - seed
- 单数据库租用
    - 模型 traits 使用全局范围限定（global scopes）
- 丰富的事件系统
- **非常高的可测试性**
- 自动租用
    - 租用引导成功后（译注：识别租户后）切换的有:
        - database connections
        - redis connections
        - cache tags
        - filesystem roots
        - queue context
- 手动租用
    - 模型 traits
- 开箱即用的租户识别
    - 域名识别
    - 子域名识别
    - 路径识别
    - 请求数据识别
    - 中间件——为以上几种识别方法而生
    - 命令行界面参数识别
    - 手动识别 (例如在 tinker 中)
- 与许多的其他包集成（可一起稳定的运行）
    - spatie/laravel-medialibrary
    - spatie/laravel-activitylog
    - Livewire
    - Laravel Nova
        - 管理租户
        - **在租户应用程序内部使用**
    - Laravel Horizon
    - Laravel Telescope
    - Laravel Passport
- **在多个租户数据库之间同步用户 (或任意其他数据库资源)**
- 当前租户的依赖项注入
- 租户的 **用户摸您**
- **缓存租户查找**，适用于所有租户的解析器
