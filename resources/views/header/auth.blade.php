<x-header.link href="{{ route('home') }}">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
        <path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
        <path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
    </svg>
</x-header.link>

<x-header.link type="dropdown" id="user-header-dropdown">
    {{ Auth::user()->username }}

    <x-slot:dropdown>
        <li class="w-full flex flex-row justify-start">
            <form action="{{ route('logout') }}" class="w-full flex justify-start" method="post">
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