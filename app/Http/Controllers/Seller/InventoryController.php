<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    
    public function index (Product $product, $page = null) {

        return view('seller.products.inventario', ['page' => $page])
                    ->with(compact('product'));

    }

    public function create (Product $product) {

        $stateArray = [
            array('id' => 'new', 'name' => 'Nuevo'),
            array('id' => 'used', 'name' => 'Usado'),
        ];

        return view('seller.products.edit.addInventory', ['states' => $stateArray])
            ->with(compact('product'));
    }
}
