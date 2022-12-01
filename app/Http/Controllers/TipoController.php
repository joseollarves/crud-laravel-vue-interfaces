<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use Illuminate\Http\Request;

class TipoController extends Controller
{
    public function get_tipos()
    {
        $tipos = Tipo::all();
        return response()->json([
            'tipos' => $tipos
        ], 200);
    }

    public function get_tipo($id)
    {
        $tipo = Tipo::find($id);
        return response()->json([
            'tipo' => $tipo
        ], 200);
    }

    public function estado_activo($id)
    {
        $tipo = Tipo::find($id);
        $tipo->estado = 'Activo';
        $tipo->save();
    }

    public function estado_inactivo($id)
    {
        $tipo = Tipo::find($id);
        $tipo->estado = 'Inactivo';
        $tipo->save();
    }

    public function add_tipo(Request $request)
    {
        $tipo = new Tipo();
        $tipo->nombre = $request->nombre;
        $tipo->estado = $request->estado;
        $tipo->save();
    }

    public function editar_tipo(Request $request, $id)
    {
        $tipo = Tipo::find($id);
        $tipo->nombre = $request->nombre;
        $tipo->estado = $request->estado;
        $tipo->save();
    }

    public function eliminar_tipo($id) {
        Tipo::destroy($id);
    }
}
