<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\ProductInventoryCant;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use ProtoneMedia\Splade\Facades\Toast;
use App\Services\InventoryService;

class InventoryController extends Controller
{
    
    public function index (Product $product, $page = null) {

        $inventories = (new InventoryService())->getInventories($product);

        return view('seller.products.inventario', ['page' => $page])
                    ->with(compact('product','inventories'));

    }

    public function create (Product $product) {

        $inventories = (new InventoryService())->getInventories($product);

        $stateArray = [
            array('id' => 'new', 'name' => trans('product.new')),
            array('id' => 'used', 'name' => trans('product.used')),
        ];

        return view('seller.products.inventory.add', ['states' => $stateArray])
            ->with(compact('product', 'inventories'));
    }

    public function store (Request $request, product $product) {

        $request->validate([
            'state' => [
                'required',
                Rule::in(['new', 'used']),
            ],
            'cant' => 'required|int',
            'variante' => ($product->cates->count() > 0? 'required|string|exists:product_inventories,slug' : ''),
        ]);

        if ($request->variante == null)
            $inventory = $product->inventories()->first();
        else
            $inventory = $product->inventories()->where('slug', $request->variante)->first();

        $inventory->cantInventory()->create($request->all());

        Toast::title(trans('Inventory cuantity added correctly'))
            ->rightBottom()
            ->backdrop()
            ->autoDismiss(5);

        return redirect()->back();
    }

    public function update (Request $request, ProductInventory $inventory) {

        $inventory->update($request->all());

        Toast::title(trans('Inventory updated correctly'))
            ->rightBottom()
            ->backdrop()
            ->autoDismiss(5);
    }

    public function destroy (ProductInventoryCant $inventory) {

        $inventory->delete();

        Toast::title(trans('Inventory deleted correctly'))
            ->rightBottom()
            ->backdrop()
            ->autoDismiss(5);

        return redirect()->back();
    }

}
