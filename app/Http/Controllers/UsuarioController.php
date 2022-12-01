<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class UsuarioController extends Controller
{

    public function get_usuario($id)
    {
        $usuario = User::find($id);
        return response()->json([
            'usuario' => $usuario
        ], 200);
    }

    public function get_usuarios()
    {
        $usuarios = User::all();
        return response()->json([
            'usuarios' => $usuarios
        ], 200);
    }

    public function get_perfil($id)
    {
        $usuario = User::find($id);
        return response()->json([
            'usuario' => $usuario
        ], 200);
    }

    public function actualizar_perfil(Request $request, $id)
    {
        $usuario = User::find($id);
        $usuario->name = $request->name;
        $usuario->apellido = $request->apellido;
        $usuario->cedula = $request->cedula;
        $usuario->fecha_nacimiento = $request->fecha_nacimiento;
        $usuario->numero_licencia = $request->numero_licencia;
        $usuario->fecha_vencimiento = $request->fecha_vencimiento;

        if ($usuario->foto_perfil != $request->foto_perfil) {
            $strpos = strpos($request->foto_perfil, ';');
            $sub = substr($request->foto_perfil, 0, $strpos);
            $ex = explode('/', $sub)[1];
            $name = time() . "." . $ex;
            $img = Image::make($request->foto_perfil)->resize(200, 200);
            $upload_path = public_path() . "/upload/";
            $image = $upload_path . $usuario->foto_perfil;
            $img->save($upload_path . $name);
            if (file_exists($image)) {
                @unlink($image);
            } else {
                $name = $usuario->foto_perfil;
            }
            $usuario->foto_perfil = $name;
        }



        if ($usuario->foto_licencia != $request->foto_licencia) {
            $strpos = strpos($request->foto_licencia, ';');
            $sub = substr($request->foto_licencia, 0, $strpos);
            $ex = explode('/', $sub)[1];
            $name = time() . "." . $ex;
            $img = Image::make($request->foto_licencia)->resize(200, 200);
            $upload_path = public_path() . "/upload/";
            $image = $upload_path . $usuario->foto_licencia;
            $img->save($upload_path . $name);
            if (file_exists($image)) {
                @unlink($image);
            } else {
                $name = $usuario->foto_licencia;
            }
            $usuario->foto_licencia = $name;
        }

        $usuario->save();
    }


    public function eliminar_usuario($id)
    {
        User::destroy($id);
    }
}
