<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;
use Intervention\Image\Facades\Image;

class VehiculoController extends Controller
{
    public function get_vehiculos()
    {
        $vehiculos = Vehiculo::all();
        return response()->json([
            'vehiculos' => $vehiculos
        ], 200);
    }

    public function get_vehiculo($id)
    {
        $vehiculo = Vehiculo::find($id);
        return response()->json([
            'vehiculo' => $vehiculo
        ], 200);
    }

    public function add_vehiculo(Request $request)
    {
        $vehiculo = new Vehiculo();
        $vehiculo->marca = $request->marca;
        $vehiculo->modelo = $request->modelo;
        $vehiculo->placa = $request->placa;
        $vehiculo->color = $request->color;
        $vehiculo->tipo = $request->tipo;
        $vehiculo->estado = $request->estado;

        if ($vehiculo->foto_primera != $request->foto_primera) {
            $strpos = strpos($request->foto_primera, ';');
            $sub = substr($request->foto_primera, 0, $strpos);
            $ex = explode('/', $sub)[1];
            $name = time() . "." . $ex;
            $img = Image::make($request->foto_primera)->resize(200, 200);
            $upload_path = public_path() . "/upload/";
            $image = $upload_path . $vehiculo->foto_primera;
            $img->save($upload_path . $name);
            if (file_exists($image)) {
                @unlink($image);
            } else {
                $name = $vehiculo->foto_primera;
            }
            $vehiculo->foto_primera = $name;
        }

        if ($vehiculo->foto_segunda != $request->foto_segunda) {
            $strpos = strpos($request->foto_segunda, ';');
            $sub = substr($request->foto_segunda, 0, $strpos);
            $ex = explode('/', $sub)[1];
            $name = time() . "." . $ex;
            $img = Image::make($request->foto_segunda)->resize(200, 200);
            $upload_path = public_path() . "/upload/";
            $image = $upload_path . $vehiculo->foto_segunda;
            $img->save($upload_path . $name);
            if (file_exists($image)) {
                @unlink($image);
            } else {
                $name = $vehiculo->foto_segunda;
            }
            $vehiculo->foto_segunda = $name;
        }

        if ($vehiculo->foto_tercera != $request->foto_tercera) {
            $strpos = strpos($request->foto_tercera, ';');
            $sub = substr($request->foto_tercera, 0, $strpos);
            $ex = explode('/', $sub)[1];
            $name = time() . "." . $ex;
            $img = Image::make($request->foto_tercera)->resize(200, 200);
            $upload_path = public_path() . "/upload/";
            $image = $upload_path . $vehiculo->foto_tercera;
            $img->save($upload_path . $name);
            if (file_exists($image)) {
                @unlink($image);
            } else {
                $name = $vehiculo->foto_tercera;
            }
            $vehiculo->foto_tercera = $name;
        }

        $vehiculo->save();
    }

    public function editar_vehiculo(Request $request, $id)
    {
        $vehiculo = Vehiculo::find($id);
        $vehiculo->marca = $request->marca;
        $vehiculo->modelo = $request->modelo;
        $vehiculo->placa = $request->placa;
        $vehiculo->color = $request->color;
        $vehiculo->tipo = $request->tipo;
        $vehiculo->estado = $request->estado;

        if ($vehiculo->foto_primera != $request->foto_primera) {
            $strpos = strpos($request->foto_primera, ';');
            $sub = substr($request->foto_primera, 0, $strpos);
            $ex = explode('/', $sub)[1];
            $name = time() . "." . $ex;
            $img = Image::make($request->foto_primera)->resize(200, 200);
            $upload_path = public_path() . "/upload/";
            $image = $upload_path . $vehiculo->foto_primera;
            $img->save($upload_path . $name);
            if (file_exists($image)) {
                @unlink($image);
            } else {
                $name = $vehiculo->foto_primera;
            }
            $vehiculo->foto_primera = $name;
        }

        if ($vehiculo->foto_segunda != $request->foto_segunda) {
            $strpos = strpos($request->foto_segunda, ';');
            $sub = substr($request->foto_segunda, 0, $strpos);
            $ex = explode('/', $sub)[1];
            $name = time() . "." . $ex;
            $img = Image::make($request->foto_segunda)->resize(200, 200);
            $upload_path = public_path() . "/upload/";
            $image = $upload_path . $vehiculo->foto_segunda;
            $img->save($upload_path . $name);
            if (file_exists($image)) {
                @unlink($image);
            } else {
                $name = $vehiculo->foto_segunda;
            }
            $vehiculo->foto_segunda = $name;
        }

        if ($vehiculo->foto_tercera != $request->foto_tercera) {
            $strpos = strpos($request->foto_tercera, ';');
            $sub = substr($request->foto_tercera, 0, $strpos);
            $ex = explode('/', $sub)[1];
            $name = time() . "." . $ex;
            $img = Image::make($request->foto_tercera)->resize(200, 200);
            $upload_path = public_path() . "/upload/";
            $image = $upload_path . $vehiculo->foto_tercera;
            $img->save($upload_path . $name);
            if (file_exists($image)) {
                @unlink($image);
            } else {
                $name = $vehiculo->foto_tercera;
            }
            $vehiculo->foto_tercera = $name;
        }
        $vehiculo->save();
    }

    public function eliminar_vehiculo($id) {
        Vehiculo::destroy($id);
    }
}
