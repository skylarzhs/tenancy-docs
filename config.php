<?php

use Illuminate\Support\Str;

return [
    'baseUrl'         => 'http://localhost:3000',
    'production'      => false,
    'siteName'        => 'Tenancy for Laravel中文站',
    'siteDescription' => '自动转换任意Laravel应用为多租户应用 - 无需修改代码，stancl/tenancy能自动地切换数据库连接和后端能做的所有其他事，让您能在完整的SaaS应用中使用标准的Laravel代码。满足所有多租户扩展包的绝大多数特性，单数据库或多数据库来实现多租户。',
    'githubUrl'     => 'https://github.com/stancl/tenancy',
    'githubDocsUrl' => 'https://github.com/larasaas/tenancy-docs',

    // key => display name
    'versions' => [
        'v1' => '1.x',
        'v2' => '2.x',
        'v3' => '3.x',
    ],
    'defaultVersion' => 'v3',
    'prettyUrls' => true,

    'version' => function ($page) {
        return explode('/', $page->getPath())[2];
    },

    'link' => function ($page, $path) {
        return $page->baseUrl . '/docs/' . $page->version() . '/' . $path . ($page->prettyUrls ? '' : '.html');
    },

    'editLink' => function ($page) {
        return "{$page->githubDocsUrl}/edit/master/source/{$page->getRelativePath()}/{$page->getFilename()}.{$page->getExtension()}";
    },

    // Algolia DocSearch credentials
    'docsearchApiKey' => '53c5eaf88e819535d98f4a179c1802e1',
    'docsearchIndexName' => 'stancl-tenancy',

    // navigation menu
    'navigation' => require_once('navigation.php'),

    // helpers
    'isActive' => function ($page, $path) {
        return Str::endsWith(trimPath($page->getPath()), trimPath($page->version() . '/' . $path));
    },
    'isActiveParent' => function ($page, $menuItem) {
        if (is_object($menuItem) && $menuItem->children) {
            return $menuItem->children->contains(function ($child) use ($page) {
                return trimPath($page->getPath()) == trimPath($child);
            });
        }
    },
    'url' => function ($page, $path) {
        return (Str::startsWith($path, 'http://') || Str::startsWith($path, 'https://')) ? $path : '/'.trimPath($path);
    },
    'isUrl' => function ($page, $path) {
        return Str::startsWith($path, 'http://') || Str::startsWith($path, 'https://');
    },
];
