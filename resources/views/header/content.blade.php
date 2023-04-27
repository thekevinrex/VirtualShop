<div class="fixed top-0 left-0 h-14 right-0 z-1024">
    <div class="w-full h-14 flex items-center bg-white border-b border-gray-200 dark:bg-dark dark:border-neutral-700 flex-row px-4 justify-between">

        <div class="flex flex-row">
            @include('header.icon')
        </div>

        <div class="flex flex-row items-end space-x-3">
            
            @auth()
                @include('header.auth')
            @endauth

            @guest
                @include('header.guest')    
            @endguest
            
            <div class="py-1 pl-4 border-l dark:border-neutral-700">
                <darkModeComponent></darkModeComponent>
            </div>

        </div>
    </div>
</div>