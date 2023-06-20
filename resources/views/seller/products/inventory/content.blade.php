<div class="flex w-full flex-wrap bg-white dark:bg-dark dark:text-white pt-5">

    <div class="w-2/3 flex flex-col px-5">

        <section aria-labelledby="admin-inventory-title" aria-describedby="admin-inventory-details">

            <h1 id="admin-inventory-title" class=" flex justify-between">
                <span class="font-bold text-2xl">
                    {{__('Admin inventory')}}
                </span>

                <div>
                    <Link slideover href="{{ route('seller.products.inventory.create', $product) }}" class="py-1 px-3 rounded-md bg-transparent text-primary"  data-mdb-ripple="true" data-mdb-ripple-color="dark">
                        {{__('Add inventory')}}
                    </Link>
                </div>
            </h1>

            <p id="admin-inventory-details" class="text-sm mt-1">
                {{__('In this section you control how many units of each product variant do you want to sell')}}
            </p>

            @foreach ($inventories as $inventory)
                <div class="py-5 px-2 flex flex-col">
                    @if (count($product->cates) > 0 )
                        <div class="flex justify-between flex-row">
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

                            <div class="flex shrink-0">
                                <x-splade-data :default="['active' => ($inventory['active'] == '1'? true : false) ]">
                                    <x-splade-defer 
                                        url="{{ route('seller.products.inventory.update', $inventory) }}"
                                        method="PUT"
                                        request="{ active: (data.active? '1':'0') }"
                                        watch-value="data.active"
                                        manual
                                    >
                                    <div class="flex items-center">
                                        <input id="inventory-aviable-{{ $inventory['id'] }}" name="inventory-aviable" v-model="data.active" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        <label for="inventory-aviable-{{ $inventory['id'] }}" class="ml-2 block text-sm text-gray-900 dark:text-white">
                                            {{__('Aviable')}}
                                        </label>
                                    </div>
                                    </x-splade-defer>
                                </x-splade-data>
                            </div>
                        </div>
                    @endif
                    
                    <div class="space-y-2 my-5">

                        @if ($inventory->cantInventory->count() == 0) 
                            <p class="text-center">
                                {{__('Still you have not added any product inventory')}}
                            </p>
                        @endif

                        @foreach ($inventory->cantInventory as $cant)
                            <div class="border rounded-md py-1 px-2 flex justify-center items-center">
                                <div class="flex flex-col w-full space-y-1">
                                    <span class="text-sm">{{ $cant->state }}</span>
                                    <p>
                                        {{ trans('product.total') }} : <span class="font-bold">{{ $cant->cant }}</span>
                                    </p>
                                </div>
                                <div class="flex items-center justify-end space-x-1 shrink-0">
                                    <Link method="DELETE" href="{{ route('seller.products.inventory.destroy', $cant) }}" class="w-10 h-10 flex items-center justify-center rounded-full overflow-hidden" data-mdb-ripple="true" data-mdb-ripple-color="dark">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                            <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                        </svg>     
                                    </Link>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                <hr>
            @endforeach
        </section>

    </div>

    <div class="w-1/3 flex flex-col px-5">

        @include('seller.products.edit.information')

        @inject('inventory', 'App\Services\InventoryService')

        @php
            $totalCantInventory = $inventory::calcTotalInventory($product);
        @endphp

        <div class="border border-gray-200 rounded-md dark:border-neutral-700 p-3 space-y-4 mb-5">
            <h4 class="text-lg font-semibold">
                {{__('Inventory total')}}
            </h4>
        
            <div class="flex flex-row justify-between">
                <span>
                    {{__('New')}}
                </span>
                <span>{{ $totalCantInventory['new'] }}</span>
            </div>
        
            <div class="flex flex-row justify-between">
                <span>
                    {{__('Used')}}
                </span>
                <span>{{ $totalCantInventory['used'] }}</span>
            </div>
        
            <div class="flex flex-row justify-between">
                <span>
                    {{__('Total')}}
                </span>
                <span>{{ $totalCantInventory['total'] }}</span>
            </div>
        </div>
    </div>

</div>