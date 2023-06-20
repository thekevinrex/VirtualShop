<x-splade-modal 
    slideover 
    class="dark:bg-dark dark:text-white" 
    max-width="lg"
>
    <x-form 
        class="space-y-6 bg-white dark:bg-dark" 
        default="{ error : [] }" 
        action="{{ route('seller.products.inventory.store', $product) }}" 
        method="post"
    >
        <h1 id="inventary-title" class="text-lg font-semibold">
            {{__('Add inventory')}}
        </h1>

        <p>
            {{__('Here you can add to determinated merged mix variants a inventory')}}
        </p>

        <section aria-labelledby="inventory-type-heading" aria-describedby="inventory-type-details">
            
            <h2 id="inventory-type-heading" class="text-lg font-semibold">
                {{__('Inventory state')}}
            </h2>

            <p id="inventory-type-details">
                {{__('Select the state of the inventory that you want to add (New, Used, etc)')}}
            </p>

            <div>
                @foreach ($states as $item )
                    <div class="py-1 px-2 space-x-2 flex items-center">
                        <input 
                            value="{{ $item['id'] }}" 
                            type="radio" 
                            name="state" 
                            id="state-{{ $item['id'] }}" 
                            v-model="form.state"
                        >

                        <label for="state-{{ $item['id'] }}">
                            {{ $item['name'] }}
                        </label>
                    </div>
                @endforeach
            </div>

        </section>

        <section aria-describedby="product-cant-details" aria-labelledby="product-cant-heading">

            <h2 id="product-cant-heading" class="text-lg font-semibold">
                {{__('Inventory cuantity')}}
            </h2>

            <p class="mb-2" id="product-cant-details">
                {{__('Write the amount of units that you want to add')}}
            </p>
            
            <div class="flex max-w-[150px] w-full">
                <InputComponent v-model:value="form.cant" type="text" :inputData="{
                    'name' : 'cant',
                    'isHeader' : false,
                    'placeholder' : '{{ trans('Inventory cuantity') }}',
                    'validate' : ['Required'],
                }" >
                </InputComponent>
            </div>

        </section>

        @if (count($product->cates) > 0)
            <section aria-labelledby="select-variante-heading" aria-describedby="select-variante-details">

                <h2 id="select-variante-heading" class="text-lg font-semibold">
                    @lang('product.add_inventory_variante')
                </h2>

                <p class="mb-2" id="select-variante-details">
                    @lang('product.add_inventory_variante_help')
                </p>

                @foreach ($inventories as $inventory)

                <div class="flex items-center flex-row my-2">
                    <div class="w-10 h-10 flex items-center justify-center">
                        <input type="radio" value="{{ $inventory->slug }}" name="variante" v-model="form.variante" id="inventory-{{ $inventory->id }}">
                    </div>

                    <label for="inventory-{{ $inventory->id }}" class="flex w-full">
                        <div class="flex space-x-3 w-full overflow-x-auto overflow-y-auto">
                                                
                            @foreach($inventory['variants'] as $variant)
                        
                            <div class="flex flex-row">
                                <div class="border py-2 px-4 rounded-md flex flex-col">
                                    <span class="text-sm font-semibold">
                                        {{ $variant['cate']['name'] }}
                                    </span>

                                    {{ $variant['name'] }}
                                </div>
                            </div>
                            <div class="flex items-center mx-1 last:hidden">+</div>
                            @endforeach
                        </div>
                    </label>
                </div>

                @endforeach

            </section>
            @endif

            <button type="submit" :disabled="form.error.filter(e => {return e.error}).length > 0" class="relative flex w-full justify-center rounded-md border border-transparent disabled:bg-indigo-300 bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                @lang('product.add_inventory')
            </button>
    </x-form>
</x-splade-modal>