<div class="w-full">
    <header>
        <div class="fixed top-0 left-0 h-14 right-0 z-50">
            <div class="w-full h-14 flex items-center bg-white border-b border-gray-200 flex-row px-4 justify-between">
        
                <div class="flex flex-row">
                    @include('seller.header.icon')
                </div>
                
                <div class=" flex flex-row justify-center">
                    sadas
                </div>

                <div class="flex flex-row justify-end space-x-3">
                    
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
    </header>

    <main class="w-full mt-14">
        @yield('content')
    </main>
</div>