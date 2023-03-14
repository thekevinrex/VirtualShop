@extends('seller.layauts.container')

@section('tab-header')
<div class="sticky-top top-14 bg-white border-b border-gray-300 dark:bg-dark dark:border-neutral-700 dark:text-white flex w-full h-24 flex-col">
    <h1 class="font-bold text-2xl h-12 py-2 px-5 flex flex-row w-full items-center">

        <div class="w-10 h-10 rounded-full overflow-hidden flex justify-center items-center shrink-0">
            <Link href="{{ route('seller.products') }}" class="w-full h-full flex justify-center items-center" data-mdb-ripple="true" data-mdb-ripple-color="dark">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd" d="M2.515 10.674a1.875 1.875 0 000 2.652L8.89 19.7c.352.351.829.549 1.326.549H19.5a3 3 0 003-3V6.75a3 3 0 00-3-3h-9.284c-.497 0-.974.198-1.326.55l-6.375 6.374zM12.53 9.22a.75.75 0 10-1.06 1.06L13.19 12l-1.72 1.72a.75.75 0 101.06 1.06l1.72-1.72 1.72 1.72a.75.75 0 101.06-1.06L15.31 12l1.72-1.72a.75.75 0 10-1.06-1.06l-1.72 1.72-1.72-1.72z" clip-rule="evenodd" />
                </svg>              
            </Link>
        </div>
        <span>
            @lang('product.inventory')
        </span>
    </h1>
    <div class="flex flex-row flex-nowrap justify-between w-full h-12 items-center px-5">
        <div class="flex flex-row h-12 space-x-2 dark:text-white items-end">

            <div class="px-5 h-10 flex items-center rounded-t-md relative" data-mdb-ripple="true" data-mdb-ripple-color="dark">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 01.67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 11-.671-1.34l.041-.022zM12 9a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                </svg>
                <span class="text-xl font-semibold">@lang('product.information')</span>                          

                @if ($page == null)
                    <div class="h-1 rounded-md w-full bg-primary absolute bottom-0 left-0 right-0"></div>
                @endif
            </div>

        </div>
        
        <div class="flex flex-none justify-end px-5">

            <Link href="{{ route('seller.products.edit', $product) }}" class="py-1 px-3 rounded-md bg-transparent text-primary"  data-mdb-ripple="true" data-mdb-ripple-color="dark">@lang('product.edit')</Link>

        </div>
    </div>
</div>
@endsection

@section('content')
    @includeWhen($page == null, 'seller.products.edit.inventory')
@endsection