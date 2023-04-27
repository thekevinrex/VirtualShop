<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Listening;
use App\Models\Marca;
use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\Provincia;
use App\Models\Variante;
use App\Tables\Products;
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
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        return view('seller.products.index', [
            'products' => Products::class,
        ]);
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductRequest $request)
    {

        $safe = $request->safe();
        
        $listeningData = [
            'category_id' => $safe['category'],
            'modelo_id'   => $safe['modelo']?? null,
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
                    'with_images' => $varianteCate['with_image'],
                    'cate_name' => $varianteCate['value'],
                ];

                $savedCates[$varianteCate['id']] = $product->cates()->create($cateData);
            }
            
            $variantes = [];
            foreach ($safe['variantes'] as $varianteInfo) {
                if (in_array($varianteInfo['cate'], array_keys($savedCates)) ) {

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

        $provincias = Provincia::all()->map(function ($element) {
            return [
                'name' => $element['name'],
                'municipios' => $element->municipios,
                'id' => $element['id']
            ];
        });

        $productData = [
            'name' => $product->name,
            'description' => ($product->description == null ? '' : $product->description),
            'restric_age' => ($product->restricted_age == '0' ? false : true),
            'ratings' => $product->ratings,

            'price' => $product->price,
            'shipping' => $product->shipping,
            'shipping_aviable' => json_decode($product->shipping_aviable),
            'currency' => $product->currency,

            'details' => $product->infos->map(function ($info) {
                return [
                    'key' => $info->key,
                    'value' => $info->value,
                    'id' => $info->id,
                ];
            }),

            'inventories' => ($product->cates->count()) ? $product->inventories->map(function ($inventory){

                $mergedVariantes = json_decode($inventory->merged);
                $mergedVariantesData = [];
                foreach($mergedVariantes as $merged) {
                    $variante = Variante::find($merged);
                    $cate = $variante->cate;

                    $mergedVariantesData[] = array(
                        'name' => $variante->name,
                        'cate' => $cate->cate_name,
                    );
                }

                return [
                    'slug' => $inventory->slug,
                    'price' => $inventory->price,
                    'merged' => $mergedVariantesData,
                ];
            }) : [],
        ];

        $listeningData = [
            'category' => $product->listening->category->name,
            'marca' => $product->listening->modelo->marca->name,
            'modelo' => $product->listening->modelo->name,
            'detail' => $product->listening->modelo->detail,
        ];

        $ratings = array(
            array('name' => trans('product.allow_ratings'), 'id' => 'allow' ),
            array('name' => trans('product.revision_ratings'), 'id' => 'revision' ),
            array('name' => trans('product.disable_ratings'), 'id' => 'disable')
        );

        return view('seller.products.edit', ['ratings' => $ratings, 'data' => $productData, 'listening' => $listeningData])
            ->with(compact('product', 'provincias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProductRequest $request, Product $product)
    {

        $safe = $request->safe();

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
            'restricted_age' => ($safe['restric_age']? '1' : '0'),
            'shipping' => $safe['delivery'],
            'shipping_aviable' => json_encode($delivery),
        ];

        if ($safe['name'] != $product->name) {
            $productData['slug'] = $safe['name'];
        }

        if (count($request->safe()->only('mergedVariantes')) > 0) {
            foreach ($safe['mergedVariantes'] as $merged) {

                $inventory = ProductInventory::where('slug', $merged['slug'])->first();

                if (!$inventory) {
                    continue;
                }

                $inventory->update([
                    'price' => $merged['price'],
                ]);
            }
        }
        
        if (count($request->safe()->only('details')) > 0) {
            
            $existingDetails = array_filter(array_map(function ($e) {
                if (isset($e['id']))
                    return $e['id'];

            }, $safe['details']), function ($e) {
                return $e != null;
            });


            foreach($product->infos as $info) {
                if (!in_array($info->id, $existingDetails)){
                    $info->delete();
                }
            }

            foreach ($safe['details'] as $info) {
                if (!isset($info['id']) || !in_array($info['id'], $existingDetails)){
                    $product->infos()->create($info);
                } else if(in_array($info['id'], $existingDetails)){
                    $product->infos()->where('id', $info['id'])->update($info);
                }
            }

        }

        $product->update($productData);

        return response()->json([
            'redirect' => route('seller.products.edit', $product),
            'successMessage' => 'The Product was succefuly updated',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {

        $product->delete();

        Toast::title("The product was deleted correctly")
            ->leftBottom()
            ->backdrop()
            ->autoDismiss(5);

        return redirect()->back();
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
