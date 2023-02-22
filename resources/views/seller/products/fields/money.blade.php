<div class="flex flex-col w-2/3 p-6">

    <section  class="">

        <h1 id="product-price-heading" class="text-lg font-semibold">
            @lang('product.product_price')
        </h1>

        <p class="mb-2" id="product-price-details">
            @lang('product.product_price_help')
        </p>
        
        <div class="flex max-w-[150px] w-full">
            <InputComponent v-model:value="price.price" @field-data="fieldsData" type="text" :inputData="{
                'name' : 'price',
                'isHeader' : false,
                'placeholder' : '{{ trans('product.product_price') }}',
                'validate' : ['Required'],
            }" >
            </InputComponent>
        </div>
        
    </section>

    <hr class="my-5">

    <section class="w-full">

        <h1 id="product-merge-heading" class="text-lg font-semibold">
            @lang('product.merge_variante')
        </h1>

        <p class="mb-2" id="product-merge-details">
            @lang('product.merge_variante_help')
        </p>

        <div class="flex flex-col w-full space-y-3">
            
            <div class="flex flex-row items-center w-full" :key="merge.id" v-for="merge in price.mergedVariantes">

                <div class="flex space-x-3 w-full overflow-x-auto overflow-y-auto px-2">
                    <div class="flex flex-row" v-for="(idV, key) in merge.merged">
                        <div class="border py-2 px-4 rounded-md flex flex-col">
                            <span class="text-sm font-semibold">@{{ variantes.cates.find(element => {return variantes.variantes.find(element => {return element.id == idV}).cate == element.id }).value }}</span>
                            @{{ variantes.variantes.find(element => {return element.id == idV}).name }}
                        </div>
                        <span v-if="key < merge.merged.length - 1" class="flex items-center ml-3 font-bold text-xl">+</span>
                    </div>
                </div>

                <div class="flex max-w-[180px] flex-none w-full">
                    <span class="flex items-center mr-1 font-bold text-xl">=</span>
                    <InputComponent v-model:value="merge.price" type="text" :inputData="{
                        'name' : 'price_merge',
                        'isHeader' : false,
                        'placeholder' : '{{ trans('product.merge_variante_price') }}',
                    }" >
                    </InputComponent>
                </div>
            </div>
        </div>
    </section>

    <hr class="my-5">

    <section aria-labelledby="delivery-options-heading" aria-describedby="delivery-options-details">

        <h1 id="delivery-options-heading" class="text-lg font-semibold">
            @lang('product.delivery_option')
        </h1>

        <p class="mb-2" id="delivery-options-details">
            @lang('product.delivery_option_help')
        </p>

        <div class="flex flex-col space-y-3">
            
            <div class="flex flex-row items-center px-1">
                <div class="w-10 h-10 flex items-center justify-center flex-none">
                    <input type="radio" v-model="price.delivery" name="delirery_option" id="delivery-logistic" value="logistic">
                </div>
                <label for="delivery-logistic" class="flex flex-col w-full">
                    <span class="font-bold text-xl">@lang('product.logistic_service')</span>
                    <p>
                        @lang('product.logistic_service_help')
                    </p>
                </label>
            </div>
            <div class="flex flex-row items-center px-1">
                <div class="w-10 h-10 flex items-center justify-center flex-none">
                    <input type="radio" v-model="price.delivery" name="delirery_option" id="delivery-myself" value="myself">
                </div>

                <label for="delivery-myself" class="flex flex-col w-full">
                    <span class="font-bold text-xl">@lang('product.doit_myself')</span>
                    <p>
                        @lang('product.doit_myself_help')
                    </p>
                </label>
            </div>
        </div>

        <hr class="my-5">

        <div class="flex flex-col w-full" :key="delivery.id" v-for="delivery in price.delivery_data">

            <h3 class="text-lg">
                @{{ provincias.find(e => {return e.id == delivery.id}).name }}
            </h3>

            <div class="flex flex-col px-2 py-1 space-y-1">
                <div class="w-full py-1 flex flex-row items-center" :key="muni.id" v-for="muni in delivery.municipios">
                    <div class="w-10 h-10 flex-none flex items-center justify-center">
                        <input type="checkbox" class="rounded" :id="'delivery-' + muni.id" v-model="muni.value">
                    </div>
                    <label class="w-full text-lg font-bold" :for="'delivery-' + muni.id">@{{ provincias.find(e => {return e.id == delivery.id}).municipios.find((e) => {return e.id == muni.id}).name }}</label>

                    <div class="flex max-w-[100px] flex-none w-full" v-if="price.delivery=='myself'">
                        <span class="flex items-center mr-1 font-bold text-xl">=</span>
                        <InputComponent v-model:value="muni.price" type="text" :inputData="{
                            'name' : 'price_merge',
                            'isHeader' : false,
                            'placeholder' : '{{ trans('product.merge_variante_price') }}',
                        }" >
                        </InputComponent>
                    </div>

                </div>
            </div>
        </div>

    </section>
    
</div>

<div class="flex flex-col w-1/3 p-6">
    
    @include('seller.products.fields.information')

    <section class="mb-5" aria-labelledby="product-currency-heading" aria-describedby="product-currency-details">
        <h1 id="product-currency-heading" class="text-lg font-semibold">
            @lang('product.product_currency')
        </h1>

        <p id="product-currency-details">
            @lang('product.product_currency_help')
        </p>

        <SelectComponent v-model:value="price.currency" :initialData="{{ json_encode(array(
            [
                'id' => 'USD',
                'name' => 'USD'
            ]
        )) }}" :inputData="{
            'name' : 'currency',
            'isHeader' : true,
            'placeholder' : '{{ trans('product.product_currency') }}',
            'defaultMessage' : '{{ trans('product.chose_currency') }}',
        }">
        </SelectComponent>
    </section>

    <hr class="my-5">

    calc recomended price

    <hr class="my-5">
    
    <section class="flex flex-col" aria-labelledby="product-payment-heading" aria-describedby="product-payment-details">
        
        <h1 id="product-payment-heading" class="text-lg font-semibold">
            @lang('product.product_payment')
        </h1>

        <p id="product-payment-details">
            @lang('product.product_payment_help')
        </p>

        <div class="flex space-x-2 mt-5 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6 flex-none dark:fill-white">
                <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" />
            </svg>
            <span class="flex flex-col">
                <span class="text-lg font-semibold">@lang('product.pay_for_qvapay')</span>
                <p>@lang('product.pay_for_qvapay_help')</p>
            </span>
        </div>
    </section>

</div>