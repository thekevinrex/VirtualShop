<div class="w-full flex flex-row">

    <sidebar class="sticky-top basis-[300px] w-[300px] max-h-screen overflow-y-auto border-gray-300 overflow-x-hidden h-screen bg-white border-r flex-none flex flex-col">

        <div class="sticky-top w-full h-14 flex items-center px-4">
            @include('seller.header.icon')
        </div>
        
        @include('seller.sidebar.content')

    </sidebar>

    <div class="flex flex-col w-full">
        
        <header class="sticky-top w-full flex bg-white border-b border-gray-300 h-14">
            @include('seller.header.content')
        </header>

        <main class="w-full flex flex-col bg-gray-200">

            <tab-header class="sticky-top top-14 bg-white border-b border-gray-300 flex w-full h-24 flex-col">
                <h1 class="font-bold text-2xl h-12 py-2 px-5 flex">
                    Header
                </h1>
                <div class="flex flex-row flex-nowrap w-full h-12">
                    asda
                </div>
            </tab-header>

            @yield('content')
        </main>
    </div>

</div>