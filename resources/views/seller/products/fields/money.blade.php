<div class="flex flex-col w-2/3 p-6">

    @include('seller.products.fields.price')

    <hr class="my-5" v-if="price.mergedVariants.length > 0">

    <section 
        v-if="price.mergedVariants.length > 0" 
        aria-describedby="product-merge-details" 
        aria-labelledby="product-merge-heading"
        class="w-full"
    >
        <h1 id="product-merge-heading" class="text-lg font-semibold">
            {{__('Product merged variants')}}
        </h1>

        <p class="mb-2" id="product-merge-details">
            {{__('In this section you can add a diferent price to each of the merged variants')}}
            {{__('The merged variants are a mix of all the categories and variants')}}
        </p>

        <div class="flex flex-col w-full space-y-3">
            
            <div 
                class="flex flex-row items-center w-full" 
                :key="merge.id" 
                v-for="merge in price.mergedVariants">

                <div class="flex space-x-3 w-full overflow-x-auto overflow-y-auto px-2">
                    <div 
                        class="flex flex-row" 
                        v-for="(idV, key) in merge.merged">
                        <div class="border py-2 px-4 rounded-md flex flex-col">
                            <span class="text-sm font-semibold">
                                @{{ 
                                    variantsData.cates
                                        .find(element => {return variantsData.variants
                                        .find(element => {return element.id == idV}).cate == element.id })
                                    .value 
                                }}
                            </span>
                            @{{ variantsData.variants.find(element => {return element.id == idV}).name }}
                        </div>

                        <span 
                            v-if="key < merge.merged.length - 1" 
                            class="flex items-center ml-3 font-bold text-xl"
                        >
                            +
                        </span>
                    </div>
                </div>

                <div class="flex max-w-[180px] flex-none w-full">
                    <span class="flex items-center mr-1 font-bold text-xl">=</span>
                    <InputComponent v-model:value="merge.price" type="text" :inputData="{
                        'name' : 'price_merge',
                        'isHeader' : false,
                        'placeholder' : '{{ trans('Price') }}',
                    }" >
                    </InputComponent>
                </div>
            </div>
        </div>
    </section>

    <hr class="my-5">

    <section aria-labelledby="delivery-options-heading" aria-describedby="delivery-options-details">

        <h1 id="delivery-options-heading" class="text-lg font-semibold">
            {{__('Shipping options')}}
        </h1>

        <p class="mb-2" id="delivery-options-details">
            {{__('Select a shipping option to deliver your product to the buyers')}}
        </p>

        <div class="flex flex-col space-y-3">
            
            <div class="flex flex-row items-center px-1">
                <div class="w-10 h-10 flex items-center justify-center flex-none">
                    <input 
                        type="radio" 
                        v-model="price.shipping" 
                        name="delirery_option" 
                        id="delivery-logistic" 
                        value="logistic"
                    >
                </div>
                <label for="delivery-logistic" class="flex flex-col w-full">
                    <span class="font-bold text-xl">
                        {{__('Logistic service')}}
                    </span>
                    <p>
                        {{__('You let us handle of keep and deliver the buyed products')}}
                    </p>
                </label>
            </div>
            <div class="flex flex-row items-center px-1">
                <div class="w-10 h-10 flex items-center justify-center flex-none">
                    <input 
                        type="radio" 
                        v-model="price.shipping" 
                        name="delirery_option" 
                        id="delivery-myself" 
                        value="manual"
                    >
                </div>

                <label for="delivery-myself" class="flex flex-col w-full">
                    <span class="font-bold text-xl">
                        {{__('Doit yourself')}}
                    </span>
                    <p>
                        {{__('You are in charge of keep and deliver your products in the buyer address')}}
                    </p>
                </label>
            </div>
        </div>

        <hr class="my-5">

        <div class="flex flex-col w-full" 
            :key="delivery.id" 
            v-for="delivery in price.shipping_aviable">

            <h3 class="text-lg">
                @{{ provinces.find(e => {return e.id == delivery.id}).name }}
            </h3>

            <div class="flex flex-col px-2 py-1 space-y-1">
                <div 
                    class="w-full py-1 flex flex-row items-center" 
                    :key="muni.id" 
                    v-for="muni in delivery.municipalities"
                >
                    <div class="w-10 h-10 flex-none flex items-center justify-center">
                        <input 
                            type="checkbox" 
                            class="rounded" 
                            :id="'delivery-' + muni.id" 
                            v-model="muni.value"
                        >
                    </div>
                    <label 
                        class="w-full text-lg font-bold" 
                        :for="'delivery-' + muni.id"
                    >
                        @{{ 
                            provinces
                                .find(e => {return e.id == delivery.id}).municipalities
                                .find((e) => {return e.id == muni.id}).name 
                        }}
                    </label>

                    <div 
                        class="flex max-w-[100px] flex-none w-full" 
                        v-if="price.shipping=='manual'"
                    >
                        <span class="flex items-center mr-1 font-bold text-xl">=</span>

                        <InputComponent v-model:value="muni.price" type="text" :inputData="{
                            'name' : 'price_merge',
                            'isHeader' : false,
                            'placeholder' : '{{ trans('Price') }}',
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
            {{__('Product currency')}}
        </h1>

        <p id="product-currency-details">
            {{__('Select the product currency in wish the payment is going to be made')}}
        </p>

        <SelectComponent v-model:value="price.currency" :initialData="{{ json_encode($currencies) }}" :inputData="{
            'name' : 'currency',
            'isHeader' : true,
            'placeholder' : '{{ trans('Product currency') }}',
            'defaultMessage' : '{{ trans('Chose the product currency') }}',
        }">
        </SelectComponent>
    </section>

    @include('seller.products.fields.recomended_price')

    <hr class="my-5">
    
    <section class="flex flex-col" aria-labelledby="product-payment-heading" aria-describedby="product-payment-details">
        
        <h1 id="product-payment-heading" class="text-lg font-semibold">
            {{__('Product payment')}}
        </h1>

        <p id="product-payment-details">
            {{__('Choses the methods of payment in which the buyers can pay your product.')}}
        </p>

        <div class="flex flex-col w-full mt-5 space-y-2">
            <div 
                class="flex space-x-2 items-center"
                v-for="payment in price.payments"
            >
                <div class="w-10 h-10 flex-none flex items-center justify-center">
                    <input 
                        type="checkbox" 
                        class="rounded" 
                        :id="'payment-'+payment.key"
                        v-model="payment.value"
                    >
                </div>
                
                <label 
                    class="flex flex-col" 
                    :for="'payment-'+payment.key"
                >
                    <span class="text-lg font-semibold">
                        @{{ 
                            payments
                                .find(e => {return e.key == payment.key}).name 
                        }}
                    </span>
                    <p>
                        @{{ 
                            payments
                                .find(e => {return e.key == payment.key}).help
                        }}
                    </p>
                </label>

            </div>
        </div>
        
        
    </section>

</div>