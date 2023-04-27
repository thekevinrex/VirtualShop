@extends('seller.layauts.container')

@section('content')

    <editProductComponent :product="{{ json_encode($data) }}"  sendProductDataTo="{{ route('seller.products.update', $product) }}" :provincias="{{ json_encode($provincias) }}" v-slot="data">

        <div class="sticky-top top-14 bg-white border-b border-gray-300 dark:bg-dark dark:border-neutral-700 dark:text-white flex w-full h-12 flex-row justify-between">
            <h1 class="font-bold text-2xl h-12 py-2 px-5 flex flex-row w-full items-center">
        
                <div class="w-10 h-10 rounded-full overflow-hidden flex justify-center items-center shrink-0">
                    <Link href="{{ route('seller.products') }}" class="w-full h-full flex justify-center items-center" data-mdb-ripple="true" data-mdb-ripple-color="dark">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M2.515 10.674a1.875 1.875 0 000 2.652L8.89 19.7c.352.351.829.549 1.326.549H19.5a3 3 0 003-3V6.75a3 3 0 00-3-3h-9.284c-.497 0-.974.198-1.326.55l-6.375 6.374zM12.53 9.22a.75.75 0 10-1.06 1.06L13.19 12l-1.72 1.72a.75.75 0 101.06 1.06l1.72-1.72 1.72 1.72a.75.75 0 101.06-1.06L15.31 12l1.72-1.72a.75.75 0 10-1.06-1.06l-1.72 1.72-1.72-1.72z" clip-rule="evenodd" />
                        </svg>              
                    </Link>
                </div>
                <span>
                    @lang('product.edit_product')
                </span>
            </h1>
            
            <div class="flex shrink-0 items-center px-3">
                <button type="button" @click="data.updateProduct" :disabled="data.isDisabled" class="rounded-md border border-transparent disabled:bg-indigo-300 bg-indigo-600 py-2 px-4 text-sm text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 font-bold focus:ring-indigo-500 focus:ring-offset-2" data-mdb-ripple="true" data-mdb-ripple-color="ligth">
                    @lang ('product.save')
                </button>
            </div>
        </div>

        <div v-if="data.isLoading">
            <x-barpage-loader ></x-barpage-loader>
        </div>

        <div class="flex flex-wrap flex-row w-full bg-white dark:bg-dark dark:text-white">

            <div class="flex flex-col w-2/3 p-6">
                @include('seller.products.edit.info')

                <hr class="my-5">

                @include('seller.products.edit.price')
            </div>

            <div class="flex flex-col w-1/3 p-6">

                @include('seller.products.edit.information')
                
                <section aria-describedby="product-price-details" aria-labelledby="product-price-heading"  class="mb-5">
            
                    <h1 id="product-price-heading" class="text-lg font-semibold">
                        @lang('product.product_price')
                    </h1>
            
                    <p class="mb-2" id="product-price-details">
                        @lang('product.product_price_help')
                    </p>
                    
                    <div class="flex max-w-[150px] w-full">
                        <InputComponent v-model:value="data.price.price" @field-data="data.fieldsData" type="text" :inputData="{
                            'name' : 'price',
                            'isHeader' : false,
                            'placeholder' : '{{ trans('product.product_price') }}',
                            'validate' : ['Required'],
                        }" >
                        </InputComponent>
                    </div>
                    
                </section>

                <div class="border border-gray-200 rounded-md dark:border-neutral-700 p-3 space-y-4 mb-5">
                    <h4 class="text-lg font-semibold">
                        @lang('product.listening_data')
                    </h4>
                
                    <div class="flex flex-row justify-between">
                        <span>@lang('product.product_category')</span>
                        <span>{{ $listening['category'] }}</span>
                    </div>
                
                    <div class="flex flex-row justify-between">
                        <span>@lang('product.product_brand')</span>
                        <span>{{ $listening['marca'] }}</span>
                    </div>
                
                    <div class="flex flex-row justify-between">
                        <span>@lang('product.product_modelo')</span>
                        <span>{{ $listening['modelo'] . ($listening['detail'] != null? ' ' . $listening['detail'] : '') }}</span>
                    </div>
                
                </div>

            </div>

        </div>
        
    </editProductComponent>

@endsection