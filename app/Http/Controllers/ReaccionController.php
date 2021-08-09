<?php

namespace App\Http\Controllers;

use App\Models\Reaccion;
use Illuminate\Http\Request;

class ReaccionController extends Controller
{   
    
    private function store($id, Request $request)
    {
        
        $input = $request->all();
        Reaccion::create($input);
        return true;

    }

     //DELETE Reacciones/id
     private function delete($id)
     {
        $reaciones = Reaccion::find($id);
        if (empty($reaciones)) {
            return false;
        } else {
            Reaccion::destroy($id);
            return true;
            
        }
     }

     public function votar(Request $request)
    {
        
        $reacciones = Reaccion::where('publicacion_id', $request->publicacion_id)->where('usuario_id', $request->usuario_id)->get();
        
        if (!empty($reaciones[0])) {
            
            $this ->delete($reaciones[0]->id, $request);            
        }
            $this -> store($reaciones[0]->id, $request);

        return response()->json([
            'success' => true,
            'message' => 'hola',
        ]);
    }
 
}

