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
        $person = Persona::create($input);

        $input['password'] = Hash::make($request->password);
        $input['persona_id'] = $person->id;

        if ($request->has('profile_photo_path') && !empty($request->archivoadjunto)) {
            $input['profile_photo_path'] = $this->loadPhoto($request->archivoadjunto);
        }

        User::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Usuario creado correctamente'
        ]);
    }

    public function update($id, Request $request)
    {
        $user = User::find($id);
        if (!empty($user)){
            $input = $request->all();
            if ($request->has('password') && !empty($request->password)) {
                $input['password'] = Hash::make($request->password);
            }

            if ($request->has('profile_photo_path') && !empty($request->profile_photo_path)) {
                $input['profile_photo_path'] = $this->loadPhoto($request->profile_photo_path);
            }
            $user->update($input);
            return response()->json([
                'success' => true,
                'message' => 'PUT usuarios successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No se encontró la solicitud.'
            ]);
        }
    }

    public function signInWithEmail(Request $request){

        $user = User::whereEmail($request->email)->first();

        if(!is_null($user) && Hash::check($request->password, $user->password))
        {
            $user->apitoken = Str::random(150);
            $user->save();
            $person = Persona::find($user->persona_id);
            $user->codigo = null;

            return response()->json([
                'success' => true,
                'user' => $user,
                'person' => $person,
                'message' => 'Bienvenido al sistema'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'user' => null,
                'person' => null,
                'message' => 'Usuario o contraseña incorrectos'
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
            $user->codigo = null;

            return response()->json([
                'success' => true,
                'user' => $user,
                'person' => $person,
                'message' => 'Bienvenido al sistema'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'user' => null,
                'person' => null,
                'message' => 'Usuario o contraseña incorrectos'
            ]);
        }
    }

    public function signInWithToken(Request $request){

        $user = User::whereApitoken($request->apitoken)->whereNotNull('apitoken')->first();

        if(!is_null($user))
        {
            $person = Persona::find($user->persona_id);

            $user->codigo = null;

            return response()->json([
                'success' => true,
                'user' => $user,
                'person' => $person,
                'message' => 'Bienvenido al sistema'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'user' => null,
                'person' => null,
                'message' => 'Token invalido'
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

    private function loadPhoto($file)
    {
        $data = base64_decode($file);
		$nameFile = rand() .'_'. time() . '.png';
        $base = 'public/images/profile/';	
		$path = base_path($base) . $nameFile;  
		$im = imagecreatefromstring($data);
		if ($im !== false) {		
			if(imagepng($im, $path, 5)){
				imagedestroy($im);
            }
        }
        return $base . $nameFile;
    }

}