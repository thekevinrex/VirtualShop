<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function getRequiredCategoryData (Request $request) {

        $request->validate([
            'category_id' => 'required|int',
        ]);

        $category = Category::findOrFail($request->only('category_id'))->first();

        $required = explode("|", $category->require);

        return response()->json(['data' => $required], 200);
    }
}
