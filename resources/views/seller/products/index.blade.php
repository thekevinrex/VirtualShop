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
    @foreach ($products as $item)
        <Link href="{{ route('seller.products.inventory', $item) }}">{{ $item->name }}</Link>
    @endforeach
@endsection