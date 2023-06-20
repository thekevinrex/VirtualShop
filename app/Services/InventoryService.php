<?php

namespace App\Services;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class InventoryService {

    
    public function getInventories (Product $product) {

        $variants = [];
        if ($product->cates->count() > 0){
            $variants = Arr::flatten(
                Arr::map(
                    $product->cates()->with(['variants' => ['cate:name,id']])->get()->toArray(),
                    function ($e) {
                        return $e['variants'];
                    }
                ), 1
            );
        }

        $inventories = $product->inventories()
            ->with('cantInventory')
            ->orderBy('id')
            ->get()->map(function ($e) use ($product, $variants) {

                $e['variants'] = ($product->cates->count() > 0)
                    ? Arr::flatten(Arr::map(
                        json_decode($e['merged']),
                        function ($ee) use ($variants) {
                                return Arr::where(
                                    $variants,
                                    function ($eee) use ($ee) {
                                                        return $eee['id'] == $ee;
                                                    }
                                );
                            }
                    ), 1)
                    : [];

                return $e;
            });

        return $inventories;
    }

    public static function calcTotalInventory (Product $product){

        $response = [
            'new' => 0,
            'used' => 0,
            'total' => 0,
        ];

        $inventories = $product->inventories()->withSum([
            'cantInventory as newCont' => function (Builder $query) {
                $query->where('state', 'new');
            },
            'cantInventory as usedCont' => function (Builder $query) {
                $query->where('state', 'used');
            }
        ], 'cant')
            ->where('active', true)
            ->get();

        foreach($inventories as $inventory){

            if ($inventory->newCont != null)
                $response['new'] += $inventory->newCont;

            if ($inventory->usedCont != null)
                $response['used'] += $inventory->usedCont;

        }

        $response['total'] = $response['new'] + $response['used'];
        
        return $response;
    }
}

?>
