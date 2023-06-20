
<section 
    v-if="data.price.mergedVariants.length > 0" 
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
            v-for="merge in data.price.mergedVariants"
        >
            <div class="flex space-x-3 w-full overflow-x-auto overflow-y-auto px-2">
                <div 
                    class="flex flex-row" 
                    v-for="(mergedData, key) in merge.merged"
                >
                    <div class="border py-2 px-4 rounded-md flex flex-col">
                        <span class="text-sm font-semibold">
                            @{{ mergedData.cate }}
                        </span>
                        @{{ mergedData.name }}
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

<hr class="my-5" v-if="data.price.mergedVariants.length > 0">

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
                    v-model="data.price.shipping" 
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
                    v-model="data.price.shipping" 
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
        v-for="delivery in data.price.shipping_aviable">

        <h3 class="text-lg">
            @{{ data.provinces.find(e => {return e.id == delivery.id}).name }}
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
                        data.provinces
                            .find(e => {return e.id == delivery.id}).municipalities
                            .find((e) => {return e.id == muni.id}).name 
                    }}
                </label>

                <div 
                    class="flex max-w-[100px] flex-none w-full" 
                    v-if="data.price.shipping=='manual'"
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
