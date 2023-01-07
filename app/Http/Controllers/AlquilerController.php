<?php

namespace App\Http\Controllers;

use App\Models\Alquiler;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class AlquilerController extends Controller
{
    public function get_alquileres()
    {
        $alquileres = Alquiler::all();
        return response()->json([
            'alquileres' => $alquileres
        ], 200);
    }

    public function get_alquiler($id)
    {
        $alquiler = Alquiler::find($id);
        return response()->json([
            'alquiler' => $alquiler
        ], 200);
    }

    public function add_alquiler(Request $request)
    {
        $alquiler = new Alquiler();
        $alquiler->cliente = $request->cliente;
        $alquiler->vehiculo = $request->vehiculo;
        $alquiler->fecha_desde = $request->fecha_desde;
        $alquiler->fecha_hasta = $request->fecha_hasta;
        $alquiler->precio = $request->precio;
        $alquiler->estado = $request->estado;
        $alquiler->save();
    }

    public function editar_alquiler(Request $request, $id)
    {
        $alquiler = Alquiler::find($id);
        $alquiler->cliente = $request->cliente;
        $alquiler->vehiculo = $request->vehiculo;
        $alquiler->fecha_desde = $request->fecha_desde;
        $alquiler->fecha_hasta = $request->fecha_hasta;
        $alquiler->precio = $request->precio;
        $alquiler->estado = $request->estado;

        $alquiler->save();
    }

    public function estado_activo_alquiler($id)
    {
        $alquiler = Alquiler::find($id);
        $alquiler->estado = 'Activo';
        $alquiler->save();
    }

    public function estado_inactivo_alquiler($id)
    {
        $alquiler = Alquiler::find($id);
        $alquiler->estado = 'Inactivo';
        $alquiler->save();
    }
}
