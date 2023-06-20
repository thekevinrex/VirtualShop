<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Product;
use App\Services\PersonalizationModulesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use ProtoneMedia\Splade\Facades\Toast;

class ProductPersoController extends Controller
{
    
    public function index(Product $product) {

        $modulesData = (new PersonalizationModulesService())->getModulesWithKey();
        
        $modulesInfo = $product->modules->map(function ($e) {
            return [
                'id' => $e->id,
                'title' => $e->title,
                'description' => $e->description,
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

        $modules = (new PersonalizationModulesService())->getModulesKey();
        
        return view('seller.products.perso.add', ['modules' => $modules]);
    }

    public function store (Request $request, Product $product) {

        
        $validated = $request->validate([
            'modules.*.id' => '',
            'modules.*.order' => 'int',
            'modules.*.title' => '',
            'modules.*.description' => '',
            'modules.*.type' => '',
            'modules.*.image.image' => '',
        ]);

        $modulesData = (new PersonalizationModulesService())->getModulesWithKey();

        $existingDetails = [];

        if (isset($validated['modules'])) {
            foreach ($validated['modules'] as $module) {

                $rules = PersonalizationModulesService::getValidationRules($modulesData->get($module['type']));

                Validator::make(
                    $module,
                    $rules
                )->validate();

                if (isset($module['id']))
                    $existingDetails[] = $module['id'];
            }
        }

        foreach($product->modules as $module) {
            if (!in_array($module->id, $existingDetails)){
                $module->delete();
            }
        }

        if (isset($validated['modules'])) {
            foreach ($validated['modules'] as $moduleData) {
                if (isset($moduleData['id']) && in_array($moduleData['id'], $existingDetails)){

                    $module = $product->modules()->find($moduleData['id']);

                    $module->update($moduleData);

                    if ($module->image->url != $moduleData['image']['image']){
                        $module->image()->delete();
                        $module->image()->create(['url' => $moduleData['image']['image']]);
                    }
                } else {
                    $module = $product->modules()->create($moduleData);
                    $module->image()->create(['url' => $moduleData['image']['image']]);
                }
            }
        }

        Toast::message(trans('The product modules has been updated'))
            ->backdrop()
            ->rightBottom()
            ->success()
            ->autoDismiss(5);

        return redirect()->back();
    }
}
