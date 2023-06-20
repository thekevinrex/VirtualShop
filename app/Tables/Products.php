<?php

namespace App\Tables;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class Products extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {

        $seller = Auth::user()->seller;
        
        return Product::query()->with([
                'cates' => [
                    'variants' => [
                        'image',
                    ],
                ], 
                'variant' => [
                    'image',
                ], 
                'listening' => [
                    'category',
                ],
            ])->where('seller_id', $seller->getKey());
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(columns: ['name'])
            ->column('name', sortable: true, canBeHidden: false, label: trans('product.name'))
            ->column(key:'category', label: trans('product.category'))
            ->column(key:'price', label: trans('product.price'))
            ->column(key: 'state', label: trans('product.state'))
            ->column(key:'actions', label: trans('product.actions'))
            ->paginate(10);

        $table::hidePaginationWhenResourceContainsOnePage();
    }
}
