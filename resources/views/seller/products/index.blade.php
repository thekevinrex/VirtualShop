@extends('seller.layauts.container')

@section('tab-header')
    <div class="sticky-top top-14 bg-white border-b border-gray-300 dark:bg-dark dark:border-neutral-700 dark:text-white flex w-full h-24 flex-col">
        
        <h1 class="font-bold text-2xl h-12 py-2 px-5 flex">
            @lang('product.products')
        </h1>
        
        <div class="flex flex-row flex-nowrap justify-between w-full h-12 items-center">
            <div>
                
            </div>
            
            <div class="flex flex-none justify-end px-5">

                <Link href="{{ route('seller.products.create') }}" class="py-1 px-3 rounded-md bg-transparent text-primary"  data-mdb-ripple="true" data-mdb-ripple-color="dark">@lang('product.add')</Link>

            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="bg-white dark:bg-dark">
    <x-splade-table :for="$products" striped>
        
        <x-splade-cell name as="$product">
            <div class="flex flex-row items-start">
                <Link href="{{ route('seller.products.inventory', $product) }}" class="w-32 h-20 flex items-center break-words shrink-0">
                    <img class="w-full h-full" src="{{ Storage::url($product->image->url) }}" alt="Product Image">
                </Link>

                <div class="w-full py-2 px-3 flex flex-col items-start justify-start">
                    <Link href="{{ route('seller.products.inventory', $product) }}" class="text-base font-semibold">{{ $product->name }}</Link>
                    <p>

                    </p>
                </div>
            </div>
        </x-splade-cell>

        <x-splade-cell category as="$product">
            <div class="flex flex-row items-center">
                {{ $product->listening->category->name }}
            </div>
        </x-splade-cell>

        <x-splade-cell price as="$product">
            <div class="text-green-500">
                {{ $product->price }}
            </div>
        </x-splade-cell>

        <x-splade-cell state as="$product">
            <div class="flex flex-row items-center">
                {{ $product->state }}
            </div>
        </x-splade-cell>
        
        <x-splade-cell actions as="$product">
            <div class="flex flex-row items-center">
                
                <Link href="{{ route('seller.products.edit', $product) }}" class="w-8 h-8 flex items-center justify-center text-black dark:text-white overflow-hidden rounded-full m-1" data-mdb-ripple="true" data-mdb-ripple-color="dark">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
                        <path d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
                    </svg>
                </Link>
                
                <Link
                    confirm-danger="{{ trans('product.delete_product_q') }}"
                    confirm-text="{{ trans('product.delete_product_q_help') }}"
                    confirm-button="{{ trans('product.delete') }}"
                    method="DELETE" href="{{ route('seller.products.delete', $product) }}" 
                    class="w-8 h-8 flex items-center justify-center text-black dark:text-white overflow-hidden rounded-full m-1" data-mdb-ripple="true" data-mdb-ripple-color="dark">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                    </svg>
                </Link>

            </div>
        </x-splade-cell>

    </x-splade-table>
</div>

@endsection