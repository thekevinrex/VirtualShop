<x-splade-modal slideover max-width="lg">
    <x-form class="space-y-6 bg-white dark:bg-dark" default="{ error : [] }" action="{{ route('seller.products.inventory.store', $product) }}" method="post">
    
        <h1 id="inventary-title" class="text-lg font-semibold">
            Add inventary
        </h1>

        <p>
            
        </p>

        <section aria-labelledby="inventory-type-heading" aria-describedby="inventory-type-details">
            
            <h1 id="inventory-type-heading" class="text-lg font-semibold">
                @lang('product.product_state')
            </h1>

            <p id="inventory-type-details">
                @lang('product.product_state_help')
            </p>

            <div>

                @foreach ($states as $item )
                    
                    <div>
                        <input value="{{ $item['id'] }}" type="radio" name="product-state" id="state-{{ $item['id'] }}" v-model="form.state">

                        <label for="state-{{ $item['id'] }}">{{ $item['name'] }}</label>
                    </div>
                
                @endforeach
                
            </div>

        </section>

        <section>

            <h1 id="product-price-heading" class="text-lg font-semibold">
                @lang('product.product_price')
            </h1>

            <p class="mb-2" id="product-price-details">
                @lang('product.product_price_help')
            </p>
            
            <div class="flex max-w-[150px] w-full">
                <InputComponent v-model:value="form.cant" type="text" :inputData="{
                    'name' : 'price',
                    'isHeader' : false,
                    'placeholder' : '{{ trans('product.product_price') }}',
                    'validate' : ['Required'],
                }" >
                </InputComponent>
            </div>

        </section>
    </x-form>
</x-splade-modal>