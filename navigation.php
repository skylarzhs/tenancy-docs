<?php

return [
    'v1' => [
        'Getting Started' => [
            'url' => 'getting-started',
            'children' => [
                'Installation' => 'installation',
                'Storage Drivers' => 'storage-drivers',
                'This Package vs Others' => 'difference-between-this-package-and-others',
                'Configuration' => 'configuration',
            ],
        ],
        'Usage' => [
            'url' => 'usage',
            'children' => [
                'Creating Tenants' => 'creating-tenants',
                'Tenant Routes' => 'tenant-routes',
                'Tenant Storage' => 'tenant-storage',
                'Tenant Manager' => 'tenant-manager',
                'Console Commands' => 'console-commands',
            ],
        ],
        'Digging Deeper' => [
            'url' => 'digging-deeper',
            'children' => [
                'Middleware Configuration' => 'middleware-configuration',
                'Custom Database Names' => 'custom-database-names',
                'Filesystem Tenancy' => 'filesystem-tenancy',
                'Jobs & Queues' => 'jobs-queues',
                'Event System' => 'event-system',
                'Tenancy Initialization' => 'tenancy-initialization',
                'Application Testing' => 'application-testing',
                'Writing Storage Drivers' => 'writing-storage-drivers',
                'Development' => 'development',
            ],
        ],
        'Integrations' => [
            'url' => 'integrations',
            'children' => [
                'Telescope' => 'telescope',
                'Horizon' => 'horizon',
            ],
        ],
        'Tips' => [
            'children' => [
                'HTTPS Certificates' => 'https-certificates',
                'Misc' => 'misc-tips',
            ],
        ],
        'Stay Updated' => 'stay-updated',
        'GitHub' => 'https://github.com/stancl/tenancy',
    ],
    'v2' => [
        'Upgrading from 1.x' => 'upgrading',
        'Getting Started' => [
            'url' => 'getting-started',
            'children' => [
                'Installation' => 'installation',
                'Storage Drivers' => 'storage-drivers',
                'This Package vs Others' => 'difference-between-this-package-and-others',
                'Configuration' => 'configuration',
            ],
        ],
        'Usage' => [
            'url' => 'usage',
            'children' => [
                'Creating Tenants' => 'creating-tenants',
                'Tenant Migrations'=> 'tenant-migrations',
                'Tenant Routes' => 'tenant-routes',
                'Tenant Storage' => 'tenant-storage',
                'Tenant Manager' => 'tenant-manager',
                'Console Commands' => 'console-commands',
            ],
        ],
        'Digging Deeper' => [
            'url' => 'digging-deeper',
            'children' => [
                'Tenants' => 'tenants',
                'Central App' => 'central-app',
                'Universal Routes' => 'universal-routes',
                'Cached Tenant Lookup' => 'cached-tenant-lookup',
                'PostgreSQL schema separation' => 'postgres-schema-separation',
                'Custom Database Names' => 'custom-database-names',
                'Custom DB Connections' => 'custom-db-connections',
                'Disabling DB Creation' => 'disabling-db-creation',
                'Filesystem Tenancy' => 'filesystem-tenancy',
                'Jobs & Queues' => 'jobs-queues',
                'Hooks / Events' => 'hooks',
                'Tenancy Initialization' => 'tenancy-initialization',
                'Tenancy Bootstrappers' => 'tenancy-bootstrappers',
                'Application Testing' => 'application-testing',
                'Tenant-Aware Commands' => 'tenant-aware-commands',
                'Middleware Configuration' => 'middleware-configuration',
                'Writing Storage Drivers' => 'writing-storage-drivers',
            ],
        ],
        'Optional Features' => [
            'url' => 'features',
            'children' => [
                'Tenant Config' => 'features/tenant-config',
                'Timestamps' => 'features/timestamps',
                'Tenant Redirect' => 'features/tenant-redirect',
            ],
        ],
        'Integrations' => [
            'url' => 'integrations',
            'children' => [
                'Spatie Packages' => 'spatie',
                'Horizon' => 'horizon',
                'Passport' => 'passport',
                'Nova' => 'nova',
                'Telescope' => 'telescope',
                'Livewire' => 'livewire',
            ],
        ],
        'Tips' => [
            'children' => [
                'HTTPS Certificates' => 'https-certificates',
                'Misc' => 'misc-tips',
            ],
        ],
        'Stay Updated' => 'stay-updated',
        'GitHub' => 'https://github.com/stancl/tenancy',
        'Tutorial' => 'https://samuelstancl.me/blog/make-your-laravel-app-multi-tenant-without-changing-a-line-of-code/',
    ],
    'v3' => [
        'SaaS boilerplate' => 'https://tenancyforlaravel.com/saas-boilerplate/',
        'GitHub' => 'https://github.com/stancl/tenancy',
        '赞助' => 'https://tenancyforlaravel.com/donate',
        '从 2.x 升级' => 'upgrading',

        '介绍' => [
            'children' => [
                '介绍' => 'introduction',
                '快速开始' => 'quickstart',
                '安装' => 'installation',
                '配置' => 'configuration',
                '与其他包比较' => 'package-comparison',
            ],
        ],

        '概念' => [
            'children' => [
                '两个应用程序' => 'the-two-applications',
                '租户' => 'tenants',
                '域名' => 'domains',
                '事件系统' => 'event-system',
                '路由' => 'routes',
                '租户引导' => 'tenancy-bootstrappers',
                '可选特征' => [
                    'url' => 'optional-features',
                    'children' => [
                        '用户模拟' => 'features/user-impersonation',
                        'Telescope tags' => 'features/telescope-tags',
                        '租户配置' => 'features/tenant-config',
                        'Cross-domain redirect' => 'features/cross-domain-redirect',
                        'Universal routes' => 'features/universal-routes',
                    ],
                ],
            ],
        ],

        '租户模式' => [
            'children' => [
                '自动模式' => 'automatic-mode',
                '手动模式' => 'manual-mode',
            ],
        ],

        '单数据库方式租用' => [
            'children' => [
                '单数据库方式租用' => 'single-database-tenancy',
            ],
        ],

        '识别租户' => [
            'children' => [
                '租户识别' => 'tenant-identification',
                '早期识别' => 'early-identification',
            ],
        ],

        '多数据库方式租用' => [
            'children' => [
                '多数据库方式租用' => 'multi-database-tenancy',
                '迁移' => 'migrations',
                '数据库定制' => 'customizing-databases',
                '租户间同步资源' => 'synced-resources-between-tenants',
                'Session scoping' => 'session-scoping',
                '队列' => 'queues',
            ],
        ],

        '深入了解' => [
            'children' => [
                '手动初始化' => 'manual-initialization',
                '测试' => 'testing',
                '与其他包集成' => [
                    'url' => 'integrating',
                    'children' => [
                        'Spatie 包' => 'integrations/spatie',
                        'Horizon' => 'integrations/horizon',
                        'Passport' => 'integrations/passport',
                        'Nova' => 'integrations/nova',
                        'Telescope' => 'integrations/telescope',
                        'Livewire' => 'integrations/livewire',
                    ],
                ],
                '控制台命令行' => 'console-commands',
                '缓存查询' => 'cached-lookup',
                '实时门面' => 'realtime-facades',
                '租户维护模式' => 'tenant-maintenance-mode',
            ],
        ],

        '赞助者专属内容' => [
            'children' => [
                '赞助商独家内容' => 'https://sponsors.tenancyforlaravel.com/',
                '租户和使用Cashier计费' => 'https://sponsors.tenancyforlaravel.com/billable-tenants-with-cashier',
                '中心授权 (类似SSO) ' => 'https://sponsors.tenancyforlaravel.com/central-sso-like-authentication',
                '使用 Ploi 定制 https 证书' => 'https://sponsors.tenancyforlaravel.com/customer-https-certificates-with-ploi',
                '在 Ploi 上部署应用程序' => 'https://sponsors.tenancyforlaravel.com/deploying-applications-to-ploi',
                'frictionless testing setup' => 'https://sponsors.tenancyforlaravel.com/frictionless-testing-setup',
                '员工培训流程' => 'https://sponsors.tenancyforlaravel.com/queued-onboarding-flow',
                '梳理代码和结构变得更清晰' => 'https://sponsors.tenancyforlaravel.com/structuring-the-codebase-for-clarity',
                '使用 Ploi 管理租户数据库' => 'https://sponsors.tenancyforlaravel.com/tenant-database-management-with-ploi',
                'Universal (Central & Tenant) Nova' => 'https://sponsors.tenancyforlaravel.com/universal-central-and-tenant-nova',
            ],
        ],
    ],
];
