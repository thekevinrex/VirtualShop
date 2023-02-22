<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Marca;
use App\Models\Product;
use App\Models\Provincia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $products = Auth::guard('seller')->user()->products;

        return view('seller.products.index')
            ->with(compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::all();
        $marcas = Marca::all();
        $provincias = Provincia::all()->map(function ($element) {
            return [
                'name' => $element['name'],
                'municipios' => $element->municipios,
                'id' => $element['id']
            ];
        });

        $ratings = array(
            array('name' => trans('product.allow_ratings'), 'id' => 'allow' ),
            array('name' => trans('product.revision_ratings'), 'id' => 'revision' ),
            array('name' => trans('product.disable_ratings'), 'id' => 'disable')
        );

        return view('seller.products.create', ['ratings' => $ratings])
            ->with(compact('categories', 'marcas', 'provincias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function getRequiredCategoryData (Request $request) {

        $request->validate([
            'category' => 'required|int',
        ]);

        $category = Category::findOrFail($request->only('category'))->first();

        $required = explode("|", $category->require);

        return response()->json(['data' => $required], 200);
    }

    public function getModelos (Request $request) {

        $request->validate([
            'id' => 'required|int',
        ]);

        $marca = Marca::find($request->only('id'))->first();
        $modelos = $marca->modelos;

        $modelos->map(function ($modelo) {
            $modelo['name'] = $modelo['name'] . ' ' . $modelo['detail'];
            return $modelo;
        });

        return response()->json(['data' => $modelos], 200);
    }
}
