<main role="main" class="h-full">
    <div class="flex flex-row w-full dark:bg-dark">

        <div class="flex lg:w-[450px] md:w-[350px] max-md:border-none w-full flex-shrink-0 flex-grow-0 flex-none border-r border-gray-300 flex-col py-12 px-10 space-y-3 relative dark:border-neutral-700">
            
            <div class="flex flex-row justify-between items-center">
                @include('seller.header.icon')

                <darkModeComponent></darkModeComponent>
            </div>

            @yield('auth-form')

        </div>

        <div class="sticky-top flex max-md:hidden w-full h-screen max-h-screen justify-center items-center">
            <img src="{{ Vite::asset('resources/images/mercado-back.jpg') }}" class="w-full h-full" alt="" srcset="">
        </div>
    </div>
</main>