<div class="w-full">
    <header>
        <div class="fixed top-0 left-0 h-14 right-0 z-50">
            <div class="w-full h-14 flex items-center bg-white dark:bg-dark dark:border-neutral-700 border-b border-gray-200 flex-row px-4 justify-between">
        
                <div class="flex flex-row">
                    @include('seller.header.icon')
                </div>
                
                <div class=" flex flex-row justify-center max-lg:hidden">
                    
                    <Link href="{{ route('seller.pricing') }}" @class(['h-14 px-5 flex items-center border-b-4', 'border-b-blue-600' => (Route::is('seller.pricing')) ]) data-mdb-ripple="true" data-mdb-ripple-color="dark">
                        <div class="font-medium text-base dark:text-white">
                            Pricing
                        </div>
                    </Link>

                </div>

                <div class="flex flex-row justify-end space-x-3 items-center">
                    
                    <darkModeComponent></darkModeComponent>

                    @auth('seller')
                        @includeWhen(Auth::guard('seller')->user()->isNotStartUp(), 'seller.header.auth-start-up')
                        @includeWhen(!Auth::guard('seller')->user()->isNotStartUp(), 'seller.header.auth')
                    @endauth
                    
                    @guest('seller')
                        @include('seller.header.guest')    
                    @endguest
                    
                </div>
            </div>
        </div>
        <div class="fixed top-14 left-0 h-14 right-0 z-50 lg:hidden bg-white dark:bg-dark dark:border-neutral-700 border-b border-gray-200">
            <div class=" flex flex-row">
                    
                <Link href="{{ route('seller.pricing') }}" @class(['h-14 px-5 flex items-center border-b-4', 'border-b-blue-600' => (Route::is('seller.pricing')) ]) data-mdb-ripple="true" data-mdb-ripple-color="dark">
                    <div class="font-medium text-base dark:text-white">
                        Pricing
                    </div>
                </Link>

            </div>
        </div>
    </header>

    <main class="w-full mt-14">
        @yield('content')
    </main>
</div>