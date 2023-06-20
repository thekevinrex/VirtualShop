<?php

namespace App\Services;
use App\Models\PersonalizationModule;
use Illuminate\Support\Arr;
class PersonalizationModulesService {

    public function getModulesWithKey () {
        return
            PersonalizationModule::all()->flatMap(function ($e) {
                return [$e['key'] => json_decode($e['modules'])];
            });
    }

    public function getModulesKey () {
        return PersonalizationModule::all()->map(function ($e) {
            return $e['key'];
        });
    }

    public static function getValidationRules($modules) {
        $rules = [];

        if (in_array('left-image', $modules)) {
            $rules = [
                ...$rules,
                'image.image' => 'required',
            ];
        }

        if (in_array('title', $modules)) {
            $rules = [
                ...$rules,
                'title' => 'required|string',
            ];
        }
        
        if (in_array('description', $modules)) {
            $rules = [
                ...$rules,
                'description' => 'required|string',
            ];
        }

        return $rules;
    }
}

?>
