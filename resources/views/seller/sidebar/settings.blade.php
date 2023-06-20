<div class="flex flex-col w-full p-2">

    <Link 
        class="
            flex flex-row 
            space-x-3 rounded-md 
            bg-white hover:bg-gray-200 
            text-md px-4 py-3 items-center 
            dark:bg-dark dark:hover:bg-neutral-700 
            {{ 
                (Route::is('seller.settings') && $view == null)
                    ? 'text-blue-600' 
                    : 'dark:text-white' 
            }}" 
            href="{{ route('seller.settings') }}"
        >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path fill-rule="evenodd" d="M3 6a3 3 0 013-3h2.25a3 3 0 013 3v2.25a3 3 0 01-3 3H6a3 3 0 01-3-3V6zm9.75 0a3 3 0 013-3H18a3 3 0 013 3v2.25a3 3 0 01-3 3h-2.25a3 3 0 01-3-3V6zM3 15.75a3 3 0 013-3h2.25a3 3 0 013 3V18a3 3 0 01-3 3H6a3 3 0 01-3-3v-2.25zm9.75 0a3 3 0 013-3H18a3 3 0 013 3V18a3 3 0 01-3 3h-2.25a3 3 0 01-3-3v-2.25z" clip-rule="evenodd" />
            </svg>
          
          
            <span>
                {{__('Dashboard')}}
            </span>
    </Link>
    
    <Link 
        class="
            flex flex-row 
            space-x-3 rounded-md 
            bg-white hover:bg-gray-200 
            text-md px-4 py-3 items-center 
            dark:bg-dark dark:hover:bg-neutral-700 
            {{ 
                (Route::is('seller.settings') && $view == 'info')
                    ? 'text-blue-600' 
                    : 'dark:text-white' 
            }}" 
            href="{{ route('seller.settings', 'info') }}"
        >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path fill-rule="evenodd" d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 00-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 00-2.282.819l-.922 1.597a1.875 1.875 0 00.432 2.385l.84.692c.095.078.17.229.154.43a7.598 7.598 0 000 1.139c.015.2-.059.352-.153.43l-.841.692a1.875 1.875 0 00-.432 2.385l.922 1.597a1.875 1.875 0 002.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 002.28-.819l.923-1.597a1.875 1.875 0 00-.432-2.385l-.84-.692c-.095-.078-.17-.229-.154-.43a7.614 7.614 0 000-1.139c-.016-.2.059-.352.153-.43l.84-.692c.708-.582.891-1.59.433-2.385l-.922-1.597a1.875 1.875 0 00-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 00-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 00-1.85-1.567h-1.843zM12 15.75a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z" clip-rule="evenodd" />
            </svg>
          
            <span>
                {{__('Seller information')}}
            </span>
    </Link>
    
    <Link 
        class="
            flex flex-row 
            space-x-3 rounded-md 
            bg-white hover:bg-gray-200 
            text-md px-4 py-3 items-center 
            dark:bg-dark dark:hover:bg-neutral-700 
            {{ 
                (Route::is('seller.settings') && $view == 'payment')
                    ? 'text-blue-600' 
                    : 'dark:text-white' 
            }}" 
            href="{{ route('seller.settings', 'payment') }}"
        >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path d="M4.5 3.75a3 3 0 00-3 3v.75h21v-.75a3 3 0 00-3-3h-15z" />
                <path fill-rule="evenodd" d="M22.5 9.75h-21v7.5a3 3 0 003 3h15a3 3 0 003-3v-7.5zm-18 3.75a.75.75 0 01.75-.75h6a.75.75 0 010 1.5h-6a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3z" clip-rule="evenodd" />
            </svg>
          
          
            <span>
                {{__('Seller payment')}}
            </span>
    </Link>
    
    <Link 
        class="
            flex flex-row 
            space-x-3 rounded-md 
            bg-white hover:bg-gray-200 
            text-md px-4 py-3 items-center 
            dark:bg-dark dark:hover:bg-neutral-700 
            {{ 
                (Route::is('seller.settings') && $view == 'address')
                    ? 'text-blue-600' 
                    : 'dark:text-white' 
            }}" 
            href="{{ route('seller.settings', 'address') }}"
        >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path d="M4.5 3.75a3 3 0 00-3 3v.75h21v-.75a3 3 0 00-3-3h-15z" />
                <path fill-rule="evenodd" d="M22.5 9.75h-21v7.5a3 3 0 003 3h15a3 3 0 003-3v-7.5zm-18 3.75a.75.75 0 01.75-.75h6a.75.75 0 010 1.5h-6a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3z" clip-rule="evenodd" />
            </svg>
          
          
            <span>
                {{__('Seller address')}}
            </span>
    </Link>
    
</div>

<hr>