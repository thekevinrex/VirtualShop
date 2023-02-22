<div class="w-full h-14 flex items-center flex-row px-4 justify-between">
    <div class="flex flex-row">

        <div @click="page.toggleSidebar" aria-label="Toggle the visibility of the sidebar" class="w-10 h-10 rounded-full flex flex-none items-center justify-center dark:text-white" data-mdb-ripple="true" data-mdb-ripple-color="dark">
            <svg v-if="!page.isSidebarOpen" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>              
            <svg v-if="page.isSidebarOpen" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path fill-rule="evenodd" d="M3 6.75A.75.75 0 013.75 6h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 6.75zM3 12a.75.75 0 01.75-.75H12a.75.75 0 010 1.5H3.75A.75.75 0 013 12zm0 5.25a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75z" clip-rule="evenodd" />
            </svg>  
        </div>

    </div>
    <div class="flex flex-row items-end space-x-3">
        
        <x-header.link href="{{ route('seller.dashboard') }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                <path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
            </svg>
        </x-header.link>

        <x-header.link type="dropdown-image" id="seller-header-dropdown">
            <img src="{{ Storage::url(Auth::guard('seller')->user()->avatar->url) }}" class="w-10 h-10 rounded-full" alt="">
        
            <x-slot:dropdown>
                <li class="w-full flex flex-row justify-start">
                    <form action="{{ route('seller.logout') }}" class="w-full flex justify-start" method="post">
                        @csrf
                        <button type="submit" class="text-start dropdown-item cursor-pointer py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100">
                            @lang('auth.logout')
                        </button>
                    </form>
                </li>
                <li>
                    <div class="text-start dropdown-item cursor-pointer py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100">
                        @lang('user.profile')
                    </div>
                </li>
            </x-slot:dropdown>
        </x-header.link>

        <div class="py-1 pl-4 border-l dark:border-neutral-700">
            <darkModeComponent></darkModeComponent>
        </div>
        
    </div>
</div>