<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    // GET solicitudes
    public function index(Request $request)
    {
        /*if ($request->has('persona_id')) {
            return Solicitud::where('persona_id', $request->persona_id)->get();
        } else {*/
            return response()->json([
                'success' => true,
                'message' => 'GET request successfully',
                'data' => Solicitud::all()
            ]);
        //}
    }

    // POST solicitudes
    public function store(Request $request)
    {
        $input = $request->all();
        if ($request->has('archivoadjunto')) {
            $input['archivoadjunto'] = $this->loadPhoto($request->archivoadjunto);
        }
        User::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Solicitud creada exitosamente'
        ]);
    }

    //GET solicitudes/id
    public function show($id)
    {
        return Solicitud::findOrFail($id);
    }

    //PUT directorios/id
    public function update($id, Request $request)
    {
        $input = $request->all();
        if ($request->has('archivoadjunto')) {
            $input['archivoadjunto'] = $this->loadPhoto($request->archivoadjunto);
        }
        
        $solicitud = Solicitud::find($id);
        $solicitud->update($input);
    
        return response()->json([
            'success' => true,
            'message' => 'Registro modificado correctamente'
        ]);
    }
    
    //DELETE solicitudes/id
    public function delete($id)
    {
        Solicitud::destroy($id);
        return response()->json([
            'success' => true,
            'message' => 'Solicitud eliminada correctamente'
        ]);
    }

    private function loadPhoto($file)
    {
        $data = base64_decode($file);
		$nameFile = rand() .'_'. time() . '.png';
        $base = '/uploads/images/requests';	
		$path = base_path($base) . $nameFile;  
		$im = imagecreatefromstring($data);
		if ($im !== false) {
			$path = $path . $nameFile;			
			if(imagepng($im, $path)){
				imagedestroy($im);
            }
        }
        return $base . $nameFile;
    }

    private function hasActive($request)
    {
        $solicitudes = Solicitud::whereRaw('persona_id = $request->persona_id AND prioridad_id IS NULL');
        if ($solicitudes) {
            return false;
        }
        return true;
    }

}

