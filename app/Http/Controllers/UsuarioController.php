<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsuarioController extends Controller
{

    public function store(Request $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        User::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Usuario creado correctamente'
        ]);
    }

    public function signInWithEmail(Request $request){

        $user = User::whereEmail($request->email)->first();

        if(!is_null($user) && Hash::check($request->password, $user->password))
        {
            $user->apitoken = Str::random(150);
            $user->save();

            return response()->json([
                'sucess' => true,
                'data' => $user,
                'message' => 'Bienvenido al sistema'
            ]);
        } else {
            return response()->json([
                'sucess' => false,
                'message' => 'Correo o contraseña incorrectos'
            ]);
        }
    }

    public function signInWithUsername(Request $request){

        $user = User::whereUsuario($request->usuario)->first();

        if(!is_null($user) && Hash::check($request->password, $user->password))
        {
            $user->apitoken = Str::random(150);
            $user->save();

            $person = Persona::find($user->persona_id);

            $user->telefono = $person->telefonomovil;
            $user->codigo = null;
            $user->correo = $person->email;

            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'Bienvenido al sistema'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Usuario o contraseña incorrectos'
            ]);
        }
    }

    public function logout()
    {
        $user = auth()->user();
        $user->apitoken = null;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Has cerrado sesión'
        ]);
    }
}