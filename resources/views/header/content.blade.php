<div class="fixed top-0 left-0 h-14 right-0">
    <div class="w-full h-14 flex items-center bg-white border-b border-gray-200 flex-row px-4 justify-between">

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
            
        </div>
    </div>
</div>