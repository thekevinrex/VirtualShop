<main class="h-full">

    <div class="fixed top-1 left-1 flex justify-center items-center bg-white dark:bg-black/70 rounded-lg">
        <div class="py-2 px-2">
            <darkModeComponent></darkModeComponent>
        </div>
    </div>

    @yield('auth-form')

    @yield('bubble')

    @yield('image-background')
    
</main>