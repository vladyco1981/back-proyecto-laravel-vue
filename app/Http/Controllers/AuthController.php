<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function funLogin(Request $request)
    {
        # code...
        $credenciales = $request->validate([
            'email'=>'required|email',
            'password' => 'required'
        ]);
        if(!Auth::attempt($credenciales)){
            return response()->json(["message"=>"No autenticado"]);
        }
        $usuario = Auth::user();
        $token = $usuario->createToken("token personal")->plainTextToken;

        return response()->json([
            "access_token"=>$token,
            "type_token"=>"Bearer",
            "usuario"=>$usuario,
        ]);
    }
    public function funRegistro(Request $request)
    {
        $request->validate([
            "name"=>"required",
            'email'=>'required|email|unique:users',
            'password' =>'required',
            'c_password' =>'required|same:password',
        ]);
        $usuario = new User;
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = $request->password;
        $usuario->save();
        return response()->json(['message'=>"Usuario creado"],201);
    }
    public function funPerfil()
    {
        # code...
        return Auth::user();
    }
    public function funSalir()
    {
        # code...
        Auth::user()->tokens()->delete();

        return response()->json([
            "Messaje"=>"Salio"
        ]);
    }
}
