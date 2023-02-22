<div class="w-full flex flex-row">
    <pageComponent v-slot="page">
        
        <div v-if="page.isSidebarOpen" class="w-full max-w-[300px] max-h-screen overflow-y-auto border-gray-300 overflow-x-hidden h-screen bg-white border-r flex-none flex flex-col dark:bg-dark dark:border-neutral-700 z-50" :class=" (page.isSidebarFixed) ? 'fixed left-0 top-14' : 'fixed max-lg:left-0 max-lg:top-14 lg:sticky-top'">

            <div class="sticky-top w-full h-14 flex items-center px-4 justify-between">
                @include('seller.header.icon')

                <div @click="page.toggleSidebarFixed" aria-label="Toggle the sidebar fixed mode unless the screen width is less than 1024px" class="w-10 h-10 flex flex-none rounded-full max-lg:hidden items-center justify-center" data-mdb-ripple="true" data-mdb-ripple-color="dark">
                    <svg v-if="!page.isSidebarFixed" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 3.75H6A2.25 2.25 0 003.75 6v1.5M16.5 3.75H18A2.25 2.25 0 0120.25 6v1.5m0 9V18A2.25 2.25 0 0118 20.25h-1.5m-9 0H6A2.25 2.25 0 013.75 18v-1.5M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <svg v-if="page.isSidebarFixed" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 9.563C9 9.252 9.252 9 9.563 9h4.874c.311 0 .563.252.563.563v4.874c0 .311-.252.563-.563.563H9.564A.562.562 0 019 14.437V9.564z" />
                    </svg>                        
                </div>
            </div>

            @include('seller.sidebar.content')
        
        </div>

        <div class="flex flex-col w-full z-10">
            
            <nav role="navigation" class="sticky-top w-full flex bg-white border-b border-gray-300 h-14 dark:bg-dark dark:border-neutral-700 z-50">
                @include('seller.header.content')
            </nav>

            <main role="main" class="w-full flex flex-col bg-gray-200 dark:bg-neutral-800">
                @yield('tab-header')

                @yield('content')
            </main>
        </div>

    </pageComponent>
</div>