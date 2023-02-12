<?php

namespace App\Http\Controllers;

use App\Models\Provincia;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    
    public function getMunicipios (Request $request) {

        $request->validate([
            'id' => 'required|int',
        ]);

        $provincia = Provincia::find($request->only('id'))->first();

        $municipios = $provincia->municipios;

        return response()->json(['data' => $municipios], 200);
    }
}
