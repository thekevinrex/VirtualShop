@extends('seller.layauts.container')

@section('content')
    
    <addProductComponent sendProductDataTo="{{ route('seller.products.store') }}" fetchCategoryDataFrom="{{ route('seller.categories.get') }}" :provincias="{{ json_encode($provincias) }}">

        <template #default="{ isLoading }">
            <div v-if="isLoading">
                <x-barpage-loader ></x-barpage-loader>
            </div>
        </template>

        <template #header="{ updateTab, actualTab, isDisabled, updateProduct }">

            <div class="w-full h-12 px-5 flex flex-row justify-between items-center dark:text-white flex-none">
                <h1 class="text-xl font-bold  ">
                    @lang('product.add')
                </h1>
            </div>

            <div class="w-full flex flex-row justify-between h-10 px-5">
                <div class="flex flex-row space-x-2 dark:text-white">

                    <div class="px-5 h-10 flex items-center rounded-md relative overflow-hidden" data-mdb-ripple="true" data-mdb-ripple-color="dark" @click="updateTab('info')">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 01.67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 11-.671-1.34l.041-.022zM12 9a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-xl font-semibold">@lang('product.information')</span>                          

                        <div v-if="actualTab == 'info'" class="h-1 rounded-md w-full bg-primary absolute bottom-0 left-0 right-0"></div>
                    </div>
                    
                    <div class="px-5 h-10 flex items-center rounded-md relative overflow-hidden" data-mdb-ripple="true" data-mdb-ripple-color="dark" @click="updateTab('variantes')">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M1.5 7.125c0-1.036.84-1.875 1.875-1.875h6c1.036 0 1.875.84 1.875 1.875v3.75c0 1.036-.84 1.875-1.875 1.875h-6A1.875 1.875 0 011.5 10.875v-3.75zm12 1.5c0-1.036.84-1.875 1.875-1.875h5.25c1.035 0 1.875.84 1.875 1.875v8.25c0 1.035-.84 1.875-1.875 1.875h-5.25a1.875 1.875 0 01-1.875-1.875v-8.25zM3 16.125c0-1.036.84-1.875 1.875-1.875h5.25c1.036 0 1.875.84 1.875 1.875v2.25c0 1.035-.84 1.875-1.875 1.875h-5.25A1.875 1.875 0 013 18.375v-2.25z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-xl font-semibold">@lang('product.variantes')</span>                          
                        <div v-if="actualTab == 'variantes'" class="h-1 rounded-md w-full bg-primary absolute bottom-0 left-0 right-0"></div>
                    </div>
                    
                    <div class="px-5 h-10 flex items-center rounded-md relative overflow-hidden" data-mdb-ripple="true" data-mdb-ripple-color="dark" @click="updateTab('money')">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path d="M10.464 8.746c.227-.18.497-.311.786-.394v2.795a2.252 2.252 0 01-.786-.393c-.394-.313-.546-.681-.546-1.004 0-.323.152-.691.546-1.004zM12.75 15.662v-2.824c.347.085.664.228.921.421.427.32.579.686.579.991 0 .305-.152.671-.579.991a2.534 2.534 0 01-.921.42z" />
                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v.816a3.836 3.836 0 00-1.72.756c-.712.566-1.112 1.35-1.112 2.178 0 .829.4 1.612 1.113 2.178.502.4 1.102.647 1.719.756v2.978a2.536 2.536 0 01-.921-.421l-.879-.66a.75.75 0 00-.9 1.2l.879.66c.533.4 1.169.645 1.821.75V18a.75.75 0 001.5 0v-.81a4.124 4.124 0 001.821-.749c.745-.559 1.179-1.344 1.179-2.191 0-.847-.434-1.632-1.179-2.191a4.122 4.122 0 00-1.821-.75V8.354c.29.082.559.213.786.393l.415.33a.75.75 0 00.933-1.175l-.415-.33a3.836 3.836 0 00-1.719-.755V6z" clip-rule="evenodd" />
                        </svg>  
                        <span class="text-xl font-semibold">@lang('product.monetizacion')</span>        
                        <div v-if="actualTab == 'money'" class="h-1 rounded-md w-full bg-primary absolute bottom-0 left-0 right-0"></div>                  
                    </div>


                </div>
                <div class="flex flex-row justify-end items-center">
                    
                    <button type="button" @click="updateProduct" :disabled="isDisabled" class="rounded-md border border-transparent disabled:bg-indigo-300 bg-indigo-600 py-2 px-4 text-sm text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 font-bold focus:ring-indigo-500 focus:ring-offset-2" data-mdb-ripple="true" data-mdb-ripple-color="ligth">
                        @lang ('product.save')
                    </button>

                </div>
            </div>
        </template>

        <template #info="{ info, price, marcas, listening, addInfo, deleteInfo, fetch_video, loading, required, fieldsData }">
            @include('seller.products.fields.info')
        </template>

        <template #variantes="{ variantes, addVarianteCate, addVariante, deleteVarianteCate, deleteVariante, selectedCate, selectVarianteCate, setCateVarianteAsMain, fieldsData }" >
            @include('seller.products.fields.variantes')
        </template>

        <template #money="{ price, variantes, provincias, fieldsData }">
            @include('seller.products.fields.money')
        </template>
        
    </addProductComponent>

@endsection