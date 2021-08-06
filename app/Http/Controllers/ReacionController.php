<?php

namespace App\Http\Controllers;

use App\Models\Reacion;
use Illuminate\Http\Request;

class ReacionController extends Controller
{   
    
    private function store($id, Request $request)
    {
        
        $input = $request->all();
        Reacion::create($input);
        return true;

    }

     //DELETE Reaciones/id
     private function delete($id)
     {
        $reacion = Reacion::find($id);
        if (empty($reacion)) {
            return false;
        } else {
            Reacion::destroy($id);
            return true;
            
        }
     }

     public function votar(Request $request)
    {
        $reacion = Reacion::where('publicacion_id', $request->publicacion_id)->where('usuario_id', $request->usuario_id)->get();
        
        if (!empty($reacion[0])) {
            $this ->delete($reacion[0]->id, $request);            
        }
            $this -> store($reacion[0]->id, $request);

        return response()->json([
            'success' => true,
            'message' => 'hola',
        ]);
    }
 
}

