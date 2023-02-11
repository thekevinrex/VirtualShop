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
    </x-slot:dropdown>
</x-header.link>