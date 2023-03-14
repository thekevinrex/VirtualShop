<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Listening;
use App\Models\Marca;
use App\Models\Product;
use App\Models\Provincia;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use ProtoneMedia\Splade\Facades\Toast;

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
    public function store(ProductRequest $request)
    {

        $safe = $request->safe();
        
        $listeningData = [
            'category_id' => $safe['category'],
            'modelo_id'   => $safe['modelo']?? null,
            'marca_id'    => $safe['marca']?? null,
            'first_name'  => $safe['name'],
        ];
        
        $listening = Listening::create($listeningData);

        $delivery = array_filter(Arr::flatten(array_map(function ($e) {
            return $e['municipios'];
        }, $safe['delivery_data']), 1), function ($ee) {
            return $ee['value'];
        } );
        
        $productData = [
            ...$request->safe()->only(
                'name', 
                'description',
                'price',
                'currency',
                'ratings'
            ),
            'slug' => $safe['name'],
            'by_seller_id' => Auth::guard('seller')->user()->id,
            'listening_id' => $listening['id'],
            'restricted_age' => ($safe['restric_age']? 1 : 0),
            'shipping' => $safe['delivery'],
            'shipping_aviable' => json_encode($delivery),
        ];

        $product = $request->user()->products()->create($productData);

        if (count($request->safe()->only('cates')) > 0) {
            $savedCates = [];
            foreach ($safe['cates'] as $varianteCate) {
                $cateData = [
                    'with_images' => ($varianteCate['with_image'] ? 1 : 0),
                    'cate_name' => $varianteCate['value'],
                ];

                $savedCates[$varianteCate['id']] = $product->cates()->create($cateData);
            }

            $variantes = [];
            foreach ($safe['variantes'] as $varianteInfo) {

                $varianteData = [
                    'name' => $varianteInfo['name'],
                    'description' => $varianteInfo['des'],
                ];

                $variante = $savedCates[$varianteInfo['cate']]->variantes()->create($varianteData);
                $variantes[$varianteInfo['id']] = $variante;

                if ($savedCates[$varianteInfo['cate']]->with_images) {
                    $variante->image()->create([
                        'url' => $varianteInfo['image']['image'],
                    ]);

                    if (count($varianteInfo['images']) > 0) {
                        foreach ($varianteInfo['images'] as $image) {
                            $variante->images()->create([
                                'url' => $image['image'],
                            ]);
                        }
                    }
                }

            }

            foreach ($safe['mergedVariantes'] as $mergedVariante) {

                $merged = [];
                $mergedName = [];
                foreach ($mergedVariante['merged'] as $mergedId) {
                    $merged[] = $variantes[$mergedId]->id;
                    $mergedName[] = $variantes[$mergedId]->name;
                }

                $mergedVarianteData = [
                    'slug' => Str::slug(implode(' ', $mergedName)),
                    'price' => $mergedVariante['price'],
                    'merged' => json_encode($merged),
                ];

                $product->inventories()->create($mergedVarianteData);
            }

        } else {
            $varianteInfo = Arr::first($safe['variantes']);

            $varianteData = [
                'name' => '',
                'des' => $varianteInfo['des'],
            ];

            $variante = $product->variante()->create($varianteData);

            $variante->image()->create([
                'url' => $varianteInfo['image']['image'],
            ]);

            if (count($varianteInfo['images']) > 0) {
                foreach ($varianteInfo['images'] as $image) {
                    $variante->images()->create([
                        'url' => $image['image'],
                    ]);
                }
            }

            $InventoryVarianteData = [
                'slug' => $product->name . ' variant' . $variante->id,
                'price' => $product->price,
                'merged' => json_encode([$variante->id]),
            ];

            $product->inventories()->create($InventoryVarianteData);
        }
        
        if (count($request->safe()->only('details')) > 0) {
            foreach (array_map(function ($e) {
                return [
                    'key' => $e['key'],
                    'value' => $e['value'],
                ];
            }, $safe['details']) as $info) {
                $product->infos()->create($info);
            }
        }

        return response()->json([
            'redirect' => route('seller.products.inventory', $product),
            'successMessage' => 'The Product was succefuly created',
        ], 200);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function show(Product $product)
    {
        
        return view('seller.products.show')
                    ->with(compact('product'));
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
