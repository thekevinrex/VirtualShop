<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    
    public function getModels (Request $request) {
        
        $request->validate([
            'id' => 'required|int',
        ]);

        $brand = Brand::find($request->only('id'))->first();

        $models = $brand->models;

        $models->map(function ($model) {
            $model['name'] = $model['name'] . ' ' . $model['detail'];
            return $model;
        });

        return response()->json(['data' => $models], 200);
    }
}
