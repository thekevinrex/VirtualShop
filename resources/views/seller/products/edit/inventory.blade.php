<div class="flex w-full flex-wrap bg-white pt-5">

    <div class="w-2/3 flex flex-col px-5">

        <section aria-labelledby="admin-inventory-title" aria-describedby="admin-inventory-details">

            <h1 id="admin-inventory-title" class=" flex justify-between">
                <span class="font-bold text-2xl">
                    @lang('product.admin_inventory')
                </span>

                <div>
                    <Link slideover href="{{ route('seller.products.inventory.create', $product) }}" class="py-1 px-3 rounded-md bg-transparent text-primary"  data-mdb-ripple="true" data-mdb-ripple-color="dark">@lang('product.add_inventory')</Link>
                </div>
            </h1>

            <p id="admin-inventory-details" class="text-sm mt-1">
                Aqui controlas la cantidad de unidades que vendes
            </p>


        </section>

    </div>

    <div class="w-1/3 flex flex-col px-5">

        @include('seller.products.edit.information')

        <div class="border border-gray-200 rounded-md dark:border-neutral-700 p-3 space-y-4 mb-5">
            <h4 class="text-lg font-semibold">
                @lang('product.inventory_total')
            </h4>
        
            <div class="flex flex-row justify-between">
                <span>@lang('product.new')</span>
                <span>1234</span>
            </div>
        
            <div class="flex flex-row justify-between">
                <span>@lang('product.used')</span>
                <span>33</span>
            </div>
        </div>
    </div>

</div>