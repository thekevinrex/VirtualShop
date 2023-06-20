<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Listening;
use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\ProductVariant;
use App\Models\Province;
use App\Models\Seller;
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
    public function create(Request $request)
    {

        $seller = ($request->route()->hasParameter('seller')) 
                    ? Seller::findOrFail($request->route()->parameter('seller')) 
                    : Auth::user()->seller;

        $categories = Category::all()->map(function ($e) {
            $e['name'] = $e['key'];
            return $e;
        });

        $brands    = Brand::all();
        $provinces = Province::with('municipalities')->get();

        $ratings = array(
            array('name' => trans('product.allow_ratings')   , 'id' => 'allow' ),
            array('name' => trans('product.revision_ratings'), 'id' => 'revision' ),
            array('name' => trans('product.disable_ratings') , 'id' => 'disable')
        );

        $currencies = array(
            array ('id' => 'USD', 'name' => 'USD'),
        );

        $payments = array(
            array(
                'key' => 'Qvapay',
                'name' => trans('product.pay_for_qvapay'),
                'help' => trans('product.pay_for_qvapay_help'),
            ),
        );

        return view('seller.products.create', ['ratings' => $ratings, 'currencies' => $currencies, 'payments' => $payments])
            ->with(compact('categories', 'brands', 'provinces', 'seller'));
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

        $seller = Seller::findOrFail($safe['seller_id'])->first();

        $listeningData = [
            'uuid' => Str::uuid(),
            'name' => $safe['name'],
            'brand_model_id' => $safe['brand_model_id'] ?? null,
            'category_id' => $safe['category_id'],
        ];
        
        $listening = Listening::create($listeningData);

        $delivery = Arr::where(
            
            Arr::flatten(
                Arr::map($safe['shipping_aviable'], function ($e) {
                    return $e['municipalities'];
                })
            , 1),

            function ($e) {
                return $e['value'];
            }

        );
        
        $productData = [
            ...$request->safe()->only(
                'name', 
                'description',
                'price',
                'currency',
                'ratings',
                'shipping',
                'restricted_age',
            ),
            'slug' => $safe['name'],
            'by_seller_id' => Auth::user()->id,
            'listening_id' => $listening['id'],
            'shipping_aviable' => json_encode($delivery),
        ];
        
        $product = $seller->products()->create($productData);

        if (count($request->safe()->only('cates')) > 0) {
            $savedCates = [];
            foreach ($safe['cates'] as $variantCate) {
                $cateData = [
                    'with_images' => $variantCate['with_images'],
                    'name'        => $variantCate['value'],
                ];

                $savedCates[$variantCate['id']] = $product->cates()->create($cateData);
            }
            
            $variants = [];
            foreach ($safe['variants'] as $variantInfo) {
                if (in_array($variantInfo['cate'], array_keys($savedCates)) ) {

                    $variantData = [
                        'name'        => $variantInfo['name'],
                        'description' => $variantInfo['des'],
                    ];

                    $variant = $savedCates[$variantInfo['cate']]->variants()->create($variantData);
                    $variants[$variantInfo['id']] = $variant;

                    if ($savedCates[$variantInfo['cate']]->with_images) {
                        $variant->image()->create([
                            'url' => $variantInfo['image']['image'],
                        ]);

                        if (count($variantInfo['images']) > 0) {
                            foreach ($variantInfo['images'] as $image) {
                                $variant->images()->create([
                                    'url' => $image['image'],
                                    'is_primary' => false,
                                ]);
                            }
                        }
                    }

                }
            }
            
            foreach ($safe['mergedVariants'] as $mergedVariant) {

                $merged = [];
                $mergedName = [];
                foreach ($mergedVariant['merged'] as $mergedId) {
                    $merged[] = $variants[$mergedId]->id;
                    $mergedName[] = $variants[$mergedId]->name;
                }

                $mergedVarianteData = [
                    'slug' => Str::slug(implode(' ', $mergedName)),
                    'price' => $mergedVariant['price'],
                    'merged' => json_encode($merged),
                ];

                $product->inventories()->create($mergedVarianteData);
            }

        } else {

            $variantInfo = Arr::first($safe['variants']);

            $variantData = [
                'name' => '',
                'des' => $variantInfo['des'],
            ];

            $variant = $product->variant()->create($variantData);

            $variant->image()->create([
                'url' => $variantInfo['image']['image'],
            ]);

            if (count($variantInfo['images']) > 0) {
                foreach ($variantInfo['images'] as $image) {
                    $variant->images()->create([
                        'url' => $image['image'],
                        'is_primary' => false,
                    ]);
                }
            }

            $InventoryVarianteData = [
                'slug' => $product->name . ' variant-' . $variant->id,
                'price' => $product->price,
                'merged' => json_encode([$variant->id]),
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
            'successMessage' => trans('The Product was succefuly created'),
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
    public function edit(Request $request, Product $product)
    {

        $seller = ($request->route()->hasParameter('seller')) 
                    ? Seller::findOrFail($request->route()->parameter('seller')) 
                    : Auth::user()->seller;

        $provinces = Province::with('municipalities')->get();

        $ratings = array(
            array('name' => trans('product.allow_ratings')   , 'id' => 'allow' ),
            array('name' => trans('product.revision_ratings'), 'id' => 'revision' ),
            array('name' => trans('product.disable_ratings') , 'id' => 'disable')
        );

        $inventories = ($product->cates->count())
            ? $product->inventories->map(function ($inventory) {

                $mergedVariantesData = [];
                foreach (json_decode($inventory->merged) as $merged) {

                    $variante = ProductVariant::with('cate')->find($merged);

                    $mergedVariantesData[] = array(
                        'name' => $variante->name,
                        'cate' => $variante->cate->name,
                    );
                }

                return [
                    'slug' => $inventory->slug,
                    'price' => $inventory->price,
                    'merged' => $mergedVariantesData,
                ];
            }) : [];

        $productData = [
            'name' => $product->name,
            'description' => ($product->description == null ? '' : $product->description),
            'restric_age' => ($product->restricted_age == '0' ? false : true),
            'ratings' => $product->ratings,

            'price' => $product->price,
            'shipping' => $product->shipping,
            'shipping_aviable' => json_decode($product->shipping_aviable),
            'currency' => $product->currency,

            'details' => $product->infos,
            'inventories' => $inventories,
        ];

        $listeningData = [
            'category' => $product->listening->category->name,
            'brand'    => $product->listening->brand_model->brand->name,
            'model'   => $product->listening->brand_model->name,
            'detail'   => $product->listening->brand_model->detail,
        ];

        return view('seller.products.edit', [
                'ratings' => $ratings, 
                'data' => $productData, 
                'listening' => $listeningData,
                'seller' => $seller,
            ])
            ->with(compact('product', 'provinces'));
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

        $delivery = Arr::where(
            
            Arr::flatten(
                Arr::map($safe['shipping_aviable'], function ($e) {
                    return $e['municipalities'];
                })
            , 1),

            function ($e) {
                return $e['value'];
            }

        );

        $productData = [
            ...$request->safe()->only(
                'name', 
                'description',
                'price',
                'currency',
                'ratings',
                'restricted_age',
                'shipping',
            ),
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
            
            $existingDetails = Arr::where(
            
                Arr::map($safe['details'], function ($e) {
                    if (isset($e['id']))
                        return $e['id'];
                }), 
    
                function ($e) {
                    return $e != null;
                },
            );

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

        } else {
            $product->infos()->delete();
        }

        $product->update($productData);

        return response()->json([
            'redirect' => route('seller.products.inventory', $product),
            'successMessage' => trans('The Product was succefuly updated'),
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

        Toast::title(trans("The product was deleted correctly"))
            ->leftBottom()
            ->backdrop()
            ->autoDismiss(5);

        return redirect()->back();
    }

}
