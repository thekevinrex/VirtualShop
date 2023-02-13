<div class="bg-white {{ (isset($simple) && $simple )? '' : 'w-[400px]'  }} m-5 rounded-xl border flex flex-col border-gray-300 p-8 space-y-4 dark:bg-dark dark:text-white dark:border-neutral-700">

    <span class="font-semibold text-blue-600 text-sm">
        Individual
    </span>

    <h1 class="text-2xl font-bold">
        $1 <span class="text-xs">/ each sell</span>
    </h1>

    <p class="text-sm font-semibold">
        Con este plan pagaras $1 por cada producto que vendas. Es un plan mas adecuado para cuando vendes menos de 40 productos al mes
    </p>

    <div class="flex flex-col space-y-2 w-full grow fill-blue-600">
        <div class="flex space-x-2 ">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6">
                <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" />
              </svg>
            <span>Unlimited products</span>
        </div>
        <div class="flex space-x-2 ">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6">
                <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" />
              </svg>
            <span>Basic product details page</span>
        </div>
        <div class="flex space-x-2 ">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6">
                <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" />
              </svg>
            <span>Shipping provider</span>
        </div>

        <div class="flex space-x-2 ">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6">
                <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" />
              </svg>
            <span>Basic Analytics</span>
        </div>

        <div class="flex space-x-2 ">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6">
                <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" />
              </svg>
            <span>Product Ratings</span>
        </div>

    </div>

    @if ( (!isset ($simple) || !$simple) && Auth::guard('seller')->check() && Auth::guard('seller')->user()->data == null )
        <Link href="{{ route('seller.start-up', 'individual') }}" class="relative flex w-full justify-center rounded-md border border-transparent disabled:bg-gray-300 bg-gray-600 py-2 px-4 text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
            Start with individual plan
        </Link>
    @endif
</div>