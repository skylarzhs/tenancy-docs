<div x-data="{ mobileMenuOpen: false }" class="relative z-10 bg-white">
  <div class="sm:px-6 md:justify-start md:space-x-10 flex items-center justify-between px-4 pt-3 pb-6">
    <div class="lg:w-0 lg:flex-1">
      <a href="{{ $page->baseUrl }}" class="flex">
      <img src="/assets/img/tenancyforlaravel.svg" alt="Tenancy for Laravel" style="height: 70px">
      </a>
    </div>
    <div class="md:hidden -my-2 -mr-2">
      <button @click="mobileMenuOpen = true" type="button" class="hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md">
        <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>
    </div>
    <nav class="md:flex hidden space-x-10">
      <div @click.away="flyoutMenuOpen = false" x-data="{ flyoutMenuOpen: false }" class="relative">
        <button type="button" @click="flyoutMenuOpen = !flyoutMenuOpen" x-state:on="Item active" x-state:off="Item inactive" :class="{ 'text-gray-900': flyoutMenuOpen, 'text-gray-500': !flyoutMenuOpen }" class="group hover:text-gray-900 focus:outline-none focus:text-gray-900 inline-flex items-center space-x-2 text-base font-medium leading-6 text-gray-500 transition duration-150 ease-in-out">
          <span>文档
          </span>
          <svg x-state:on="Item active" x-state:off="Item inactive" class="group-hover:text-gray-500 group-focus:text-gray-500 w-5 h-5 text-gray-400 transition duration-150 ease-in-out" x-bind:class="{ 'text-gray-600': flyoutMenuOpen, 'text-gray-400': !flyoutMenuOpen }" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
        </button>

        <div x-description="'Documentation' flyout menu, show/hide based on flyout menu state." x-show="flyoutMenuOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1" class="md:max-w-3xl lg:ml-0 lg:left-1/2 lg:-translate-x-1/2 absolute w-screen max-w-md mt-3 -ml-4 transform" style="display: none;">
          <div class="rounded-lg shadow-lg">
            <div class="overflow-hidden rounded-lg shadow-xs">
              <div class="sm:gap-8 sm:p-8 lg:grid-cols-2 relative z-20 grid gap-6 px-5 py-6 bg-white">
                <a href="/docs/v3/tenants" class="hover:bg-gray-50 flex items-start p-3 -m-3 space-x-4 transition duration-150 ease-in-out rounded-lg">
                  <div class="sm:h-12 sm:w-12 flex items-center justify-center flex-shrink-0 w-10 h-10 text-white bg-indigo-500 rounded-md">
                    <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                  </div>
                  <div class="space-y-1">
                    <p class="text-base font-medium leading-6 text-gray-900">
                      租户
                    </p>
                    <p class="text-sm leading-5 text-gray-500">
                     包括了租户模型的所有东西，创建租户，定制行为等。
                    </p>
                  </div>
                </a>
                <a href="/docs/v3/package-comparison" class="hover:bg-gray-50 flex items-start p-3 -m-3 space-x-4 transition duration-150 ease-in-out rounded-lg">
                  <div class="sm:h-12 sm:w-12 flex items-center justify-center flex-shrink-0 w-10 h-10 text-white bg-indigo-500 rounded-md">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                    </svg>
                  </div>
                  <div class="space-y-1">
                    <p class="text-base font-medium leading-6 text-gray-900">
                      与其他包比较
                    </p>
                    <p class="text-sm leading-5 text-gray-500">
                      这包与其他 Laravel 多租户包比较。
                    </p>
                  </div>
                </a>
                <a href="/docs/v3/event-system" class="hover:bg-gray-50 flex items-start p-3 -m-3 space-x-4 transition duration-150 ease-in-out rounded-lg">
                  <div class="sm:h-12 sm:w-12 flex items-center justify-center flex-shrink-0 w-10 h-10 text-white bg-indigo-500 rounded-md">
                    <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                  </div>
                  <div class="space-y-1">
                    <p class="text-base font-medium leading-6 text-gray-900">
                      事件系统
                    </p>
                    <p class="text-sm leading-5 text-gray-500">
                      像胶水一样把组成这个包的碎片组合在一起。
                    </p>
                  </div>
                </a>
                <a href="/docs/v3/integrating" class="hover:bg-gray-50 flex items-start p-3 -m-3 space-x-4 transition duration-150 ease-in-out rounded-lg">
                  <div class="sm:h-12 sm:w-12 flex items-center justify-center flex-shrink-0 w-10 h-10 text-white bg-indigo-500 rounded-md">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z"></path>
                    </svg>
                  </div>
                  <div class="space-y-1">
                    <p class="text-base font-medium leading-6 text-gray-900">
                      集成
                    </p>
                    <p class="text-sm leading-5 text-gray-500">
                      与其他 Laravel 包集成并验证了的列表。
                    </p>
                  </div>
                </a>
                <a href="/docs/v3/configuration" class="hover:bg-gray-50 flex items-start p-3 -m-3 space-x-4 transition duration-150 ease-in-out rounded-lg">
                  <div class="sm:h-12 sm:w-12 flex items-center justify-center flex-shrink-0 w-10 h-10 text-white bg-indigo-500 rounded-md">
                    <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                  </div>
                  <div class="space-y-1">
                    <p class="text-base font-medium leading-6 text-gray-900">
                      配置
                    </p>
                    <p class="text-sm leading-5 text-gray-500">
                      这包能正确地按照你的需求去配置行为。
                    </p>
                  </div>
                </a>
                <a href="/docs/v3/tenant-identification" class="hover:bg-gray-50 flex items-start p-3 -m-3 space-x-4 transition duration-150 ease-in-out rounded-lg">
                  <div class="sm:h-12 sm:w-12 flex items-center justify-center flex-shrink-0 w-10 h-10 text-white bg-indigo-500 rounded-md">
                    <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                  </div>
                  <div class="space-y-1">
                    <p class="text-base font-medium leading-6 text-gray-900">
                      租户识别
                    </p>
                    <p class="text-sm leading-5 text-gray-500">
                      关于识别租户的东西有：中间件、解析器（resolvers）和手动识别。
                      Everything about identifying tenants. Middlewares, resolvers, or manual identification.
                    </p>
                  </div>
                </a>
              </div>
              <div class="bg-gray-50 sm:p-8 p-5">
                <a href="/docs/v3" class="hover:bg-gray-100 flow-root p-3 -m-3 space-y-1 transition duration-150 ease-in-out rounded-md">
                  <div class="flex items-center space-x-3">
                    <div class="text-base font-medium leading-6 text-gray-900">
                      打开文档
                    </div>
                  </div>
                  <p class="text-sm leading-5 text-gray-500">
                    查看完整文档。
                  </p>
                </a>
              </div>

              <div class="bg-gray-50 sm:p-8 p-5">
                <a href="https://sponsors.tenancyforlaravel.com" class="hover:bg-gray-100 flow-root p-3 -m-3 space-y-1 transition duration-150 ease-in-out rounded-md">
                  <div class="flex items-center space-x-3">
                    <div class="text-base font-medium leading-6 text-gray-900">
                      独家内容
                    </div>
                    <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-medium leading-5 bg-indigo-100 text-indigo-800">
                      赞助者专属
                    </span>
                  </div>
                  <p class="text-sm leading-5 text-gray-500">
                    针对常见复杂问题的可操作解决方案的集合。
                  </p>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div x-data="{ flyoutMenuOpen: false }" @click.away="flyoutMenuOpen = false" class="relative">
        <button type="button" @click="flyoutMenuOpen = !flyoutMenuOpen" x-state:on="Item active" x-state:off="Item inactive" :class="{ 'text-gray-900': flyoutMenuOpen, 'text-gray-500': !flyoutMenuOpen }" class="group hover:text-gray-900 focus:outline-none focus:text-gray-900 inline-flex items-center space-x-2 text-base font-medium leading-6 text-gray-500 transition duration-150 ease-in-out">
          <span>商业
          </span>
          <svg x-state:on="Item active" x-state:off="Item inactive" class="group-hover:text-gray-500 group-focus:text-gray-500 w-5 h-5 text-gray-400 transition duration-150 ease-in-out" x-bind:class="{ 'text-gray-600': flyoutMenuOpen, 'text-gray-400': !flyoutMenuOpen }" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
        </button>
        <div x-description="'Business' flyout menu, show/hide based on flyout menu state." x-show="flyoutMenuOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1" class="left-1/2 sm:px-0 absolute w-screen max-w-xs px-2 mt-3 transform -translate-x-1/2" style="display: none;">
          <div class="rounded-lg shadow-lg">
            <div class="overflow-hidden rounded-lg shadow-xs">
              <div class="sm:gap-8 sm:p-8 relative z-20 grid gap-6 px-5 py-6 bg-white">
                <a href="/saas-boilerplate" class="hover:bg-gray-50 block p-3 -m-3 space-y-1 transition duration-150 ease-in-out rounded-md">
                  <p class="text-base font-medium leading-6 text-gray-900">
                    SaaS boilerplate
                  </p>
                  <p class="text-sm leading-5 text-gray-500">
                    一个完整的具有多租户特性的 Laravel 应用脚手架，租户注册流程，收银员计费和 Nova 管理平台。
                  </p>
                </a>
                <a href="/contact" class="hover:bg-gray-50 block p-3 -m-3 space-y-1 transition duration-150 ease-in-out rounded-md">
                  <p class="text-base font-medium leading-6 text-gray-900">
                    咨询服务
                  </p>
                  <p class="text-sm leading-5 text-gray-500">
                    我们为实现我们包或者相关特性的用户提供有偿咨询服务。
                  </p>
                </a>
                <a href="/contact" class="hover:bg-gray-50 block p-3 -m-3 space-y-1 transition duration-150 ease-in-out rounded-md">
                  <p class="text-base font-medium leading-6 text-gray-900">
                    审查（Audits）
                  </p>
                  <p class="text-sm leading-5 text-gray-500">
                    在你应用程序上线之前，包的作者来检查你们租用的实现。
                  </p>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <a target="_blank" href="https://github.com/stancl/tenancy" class="hidden xl:inline hover:text-gray-900 focus:outline-none focus:text-gray-900 text-base font-medium leading-6 text-gray-500 transition duration-150 ease-in-out">
        GitHub
      </a>
      <a target="_blank" href="https://discord.gg/vHjEyrw" class="hover:text-gray-900 focus:outline-none focus:text-gray-900 text-base font-medium leading-6 text-gray-500 transition duration-150 ease-in-out">
        讨论
      </a>
      <a href="/donate" class="hover:text-gray-900 focus:outline-none focus:text-gray-900 text-base font-medium leading-6 text-gray-500 transition duration-150 ease-in-out">
        赞助
      </a>
    </nav>
    <div class="md:flex md:flex-1 lg:w-0 items-center justify-end hidden space-x-8">
      <a href="/docs/v3/quickstart/" class="hover:text-gray-900 focus:outline-none focus:text-gray-900 text-base font-medium leading-6 text-gray-500 whitespace-no-wrap">
        教程
      </a>
      <span class="inline-flex rounded-md shadow-sm">
        <a href="/docs/" class="hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 inline-flex items-center justify-center px-4 py-2 text-base font-medium leading-6 text-white whitespace-no-wrap transition duration-150 ease-in-out bg-indigo-600 border border-transparent rounded-md">
          文档
        </a>
      </span>
    </div>
  </div>

  <div x-description="Mobile menu, show/hide based on mobile menu state." x-show="mobileMenuOpen" x-transition:enter="duration-200 ease-out" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="duration-100 ease-in" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="md:hidden absolute inset-x-0 top-0 p-2 transition origin-top-right transform">
    <div class="rounded-lg shadow-lg">
      <div class="divide-gray-50 bg-white divide-y-2 rounded-lg shadow-xs">
        <div class="px-5 pt-5 pb-6 space-y-6">
          <div class="flex items-center justify-between">
            <div>
              <img src="/assets/img/tenancyforlaravel.svg" alt="Tenancy for Laravel" style="height: 70px">
            </div>
            <div class="-mr-2">
              <button @click="mobileMenuOpen = false" type="button" class="hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md">
                <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
              </button>
            </div>
          </div>
          <div>
            <nav class="gap-7 grid grid-cols-1">
              <a href="/docs/v3/tenants" class="hover:bg-gray-50 flex items-center p-3 -m-3 space-x-4 transition duration-150 ease-in-out rounded-lg">
                <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 text-white bg-indigo-500 rounded-md">
                  <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                </div>
                <div class="text-base font-medium leading-6 text-gray-900">
                  租户
                </div>
              </a>
              <a href="/docs/v3/package-comparison" class="hover:bg-gray-50 flex items-center p-3 -m-3 space-x-4 transition duration-150 ease-in-out rounded-lg">
                <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 text-white bg-indigo-500 rounded-md">
                  <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                  </svg>
                </div>
                <div class="text-base font-medium leading-6 text-gray-900">
                  与其他包比较
                </div>
              </a>
              <a href="/docs/v3/event-system" class="hover:bg-gray-50 flex items-center p-3 -m-3 space-x-4 transition duration-150 ease-in-out rounded-lg">
                <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 text-white bg-indigo-500 rounded-md">
                  <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                </div>
                <div class="text-base font-medium leading-6 text-gray-900">
                  事件系统
                </div>
              </a>
              <a href="/docs/v3/integrating" class="hover:bg-gray-50 flex items-center p-3 -m-3 space-x-4 transition duration-150 ease-in-out rounded-lg">
                <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 text-white bg-indigo-500 rounded-md">
                  <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z"></path>
                  </svg>
                </div>
                <div class="text-base font-medium leading-6 text-gray-900">
                  集成
                </div>
              </a>
              <a href="/docs/v3/configuration" class="hover:bg-gray-50 flex items-center p-3 -m-3 space-x-4 transition duration-150 ease-in-out rounded-lg">
                <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 text-white bg-indigo-500 rounded-md">
                  <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <div class="text-base font-medium leading-6 text-gray-900">
                  配置
                </div>
              </a>
              <a href="/docs/v3/tenant-identification" class="hover:bg-gray-50 flex items-center p-3 -m-3 space-x-4 transition duration-150 ease-in-out rounded-lg">
                <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 text-white bg-indigo-500 rounded-md">
                  <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="text-base font-medium leading-6 text-gray-900">
                  租户识别
                </div>
              </a>
            </nav>
          </div>
        </div>
        <div class="px-5 py-6 space-y-6">
          <div class="grid grid-cols-2 gap-4">
            <a href="/saas-boilerplate" class="hover:text-gray-700 text-base font-medium leading-6 text-gray-900 transition duration-150 ease-in-out">
              SaaS boilerplate
            </a>
            <a href="/contact" class="hover:text-gray-700 text-base font-medium leading-6 text-gray-900 transition duration-150 ease-in-out">
              咨询服务
            </a>
            <a href="/contact" class="hover:text-gray-700 text-base font-medium leading-6 text-gray-900 transition duration-150 ease-in-out">
              审查
            </a>
            <a target="_blank" href="https://github.com/stancl/tenancy" class="hover:text-gray-700 text-base font-medium leading-6 text-gray-900 transition duration-150 ease-in-out">
              GitHub
            </a>
            <a target="_blank" href="https://discord.gg/vHjEyrw" class="hover:text-gray-700 text-base font-medium leading-6 text-gray-900 transition duration-150 ease-in-out">
              讨论
            </a>
            <a href="/donate" class="hover:text-gray-700 text-base font-medium leading-6 text-gray-900 transition duration-150 ease-in-out">
              赞助
            </a>
          </div>
          <div class="space-y-6">
            <span class="flex w-full rounded-md shadow-sm">
              <a href="/docs/v3" class="hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 flex items-center justify-center w-full px-4 py-2 text-base font-medium leading-6 text-white transition duration-150 ease-in-out bg-indigo-600 border border-transparent rounded-md">
                文档
              </a>
            </span>
            <p class="text-base font-medium leading-6 text-center text-gray-500">
              <a href="/docs/v3/quickstart" class="hover:text-indigo-500 text-indigo-600 transition duration-150 ease-in-out">
                教程
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
