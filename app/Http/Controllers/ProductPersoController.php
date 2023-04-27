<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\Splade\Facades\Toast;

class ProductPersoController extends Controller
{
    
    public function index(Product $product) {

        $modulesData = array(
            'title-des-left-image' => array('title', 'des', 'left-image'),
            'title-des-right-image' => array('title', 'des', 'right-image'),
        );

        $modulesInfo = $product->modules->map(function ($e) {
            return [
                'id' => $e->id,
                'title' => $e->title,
                'des' => $e->des,
                'order' => $e->order,
                'type' => $e->type,
                'image' => [
                    'image' => $e->image->url,
                    'path' => Storage::url($e->image->url),
                ],
            ];
        });

        return view('seller.products.perso', ['modulesData' => $modulesData, 'modulesInfo' => $modulesInfo])
            ->with(compact('product'));
    }

    public function create (Product $product) {

        $modules = array(
            'title-des-left-image',
        );

        return view('seller.products.perso.add', ['modules' => $modules]);
    }

    public function store (Request $request, Product $product) {

        $validated = $request->validate([
            'modules.*.id' => '',
            'modules.*.order' => 'int',
            'modules.*.title' => 'string',
            'modules.*.des' => '',
            'modules.*.type' => '',
            'modules.*.image.image' => '',
        ]);

        $existingDetails = [];

        if (isset($validated['modules'])) {
            $existingDetails = array_filter(array_map(function ($e) {
                if (isset($e['id']))
                    return $e['id'];

            }, $validated['modules']), function ($e) {
                return $e != null;
            });
        }

        foreach($product->modules as $module) {
            if (!in_array($module->id, $existingDetails)){
                $module->delete();
            }
        }

        if (isset($validated['modules'])) {
            foreach ($validated['modules'] as $moduleData) {
                $module = $product->modules()->create($moduleData);
                $module->image()->create(['url' => $moduleData['image']['image']]);
            }
        }

        Toast::message('The product modules has been updated')
            ->backdrop()
            ->rightBottom()
            ->success()
            ->autoDismiss(5);

        return redirect()->back();
    }
}
