<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    
    public function getMunicipios (Request $request) {

        $request->validate([
            'id' => 'required|int',
        ]);

        $provincia = Province::with('municipalities')->find($request->only('id'))->first();

        $municipios = $provincia->municipalities;
        
        return response()->json(['data' => $municipios], 200);
    }
}
