<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\ProductInventoryCant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use ProtoneMedia\Splade\Facades\Toast;

class InventoryController extends Controller
{
    
    public function index (Product $product, $page = null) {

        return view('seller.products.inventario', ['page' => $page])
                    ->with(compact('product'));

    }

    public function create (Product $product) {

        $stateArray = [
            array('id' => 'new', 'name' => trans('product.new')),
            array('id' => 'used', 'name' => trans('product.used')),
        ];

        return view('seller.products.edit.addInventory', ['states' => $stateArray])
            ->with(compact('product'));
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

        Toast::title(trans('product.inventory_added'))
            ->rightBottom()
            ->backdrop()
            ->autoDismiss(5);

        return redirect()->back();
    }

    public function update (Request $request, ProductInventory $inventory) {

        $inventory->update($request->all());

        Toast::title(trans('product.inventory_updated'))
            ->rightBottom()
            ->backdrop()
            ->autoDismiss(5);
    }

    public function destroy (ProductInventoryCant $inventory) {

        $inventory->delete();

        Toast::title(trans('product.inventory_deleted'))
            ->rightBottom()
            ->backdrop()
            ->autoDismiss(5);

        return redirect()->back();
    }


    public static function calcTotalInventory (Product $product){

        $response = [
            'new' => 0,
            'used' => 0,
            'total' => 0,
        ];

        foreach($product->inventories as $inventory) {
            foreach($inventory->cantInventory as $cant){
                $response[$cant->state] += $cant->cant;
            }
        }

        $response['total'] = $response['new'] + $response['used'];

        return $response;
    }

}
