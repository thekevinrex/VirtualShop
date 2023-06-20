<section aria-describedby="product-price-details" aria-labelledby="product-price-heading">

    <h1 id="product-price-heading" class="text-lg font-semibold">
        {{__('Product Price')}}
    </h1>

    <p class="mb-2" id="product-price-details">
        {{__('Add a comperitive price. Many buyers look for the best prices')}}
    </p>
    
    <div class="flex max-w-[150px] w-full">
        <InputComponent v-model:value="price.price" @field-data="fieldsData" type="text" :inputData="{
            'name' : 'price',
            'isHeader' : false,
            'placeholder' : '{{ trans('Product price') }}',
            'validate' : ['Required'],
        }" >
        </InputComponent>
    </div>
    
</section>