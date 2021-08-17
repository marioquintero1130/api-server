<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    // GET solicitudes
    public function index(Request $request)
    {
        if ($request->has('persona_id')) {
            return response()->json([
                'success' => true,
                'message' => 'GET request successfully',
                'data' => Solicitud::where('persona_id', $request->persona_id)->get()
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'GET request successfully',
                'data' => Solicitud::all()
            ]);
        }
    }

    // POST solicitudes
    public function store(Request $request)
    {
        if ($this->hasActive($request)) {
            return response()->json([
                'success' => false,
                'message' => 'El paciente ya cuenta con una solicitud activa.'
            ]);
        } else {
            $input = $request->all();
            if ($request->has('archivoadjunto') && !empty($request->archivoadjunto)) {
                $input['archivoadjunto'] = $this->loadPhoto($request->archivoadjunto);
            }
            Solicitud::create($input);
            return response()->json([
                'success' => true,
                'message' => 'Solicitud creada exitosamente'
            ]);
        }
    }

    //GET solicitudes/id
    public function show($id)
    {
        $solicitud = Solicitud::find($id);
        if (empty($solicitud)) {
            return response()->json([
                'success' => false,
                'message' => 'GET request fail',
                'data' => array()
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'GET request successfully',
                'data' => Solicitud::findOrFail($id)
            ]);
        }
    }

    //PUT directorios/id
    public function update($id, Request $request)
    {
        $solicitud = Solicitud::find($id);
        if (!empty($solicitud)){
            $input = $request->all();
            if ($request->has('archivoadjunto') && !empty($request->archivoadjunto)) {
                $input['archivoadjunto'] = $this->loadPhoto($request->archivoadjunto);
            }
            $solicitud->update($input);
            return response()->json([
                'success' => true,
                'message' => 'PUT solicitudes successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No se encontró la solicitud.'
            ]);
        }
    }
    
    //DELETE solicitudes/id
    public function delete($id)
    {
        $solicitud = Solicitud::find($id);
        if (empty($solicitud)) {
            return response()->json([
                'success' => false,
                'message' => 'La solicitud a eliminar no existe.'
            ]);
        } else {
            Solicitud::destroy($id);
            return response()->json([
                'success' => true,
                'message' => 'DELETE solicitudes succesfully'
            ]);
        }
    }

    private function loadPhoto($file)
    {
        $data = base64_decode($file);
		$nameFile = rand() .'_'. time() . '.png';
        $base = 'public/images/requests/';	
		$path = base_path($base) . $nameFile;  
		$im = imagecreatefromstring($data);
		if ($im !== false) {		
			if(imagepng($im, $path, 5)){
				imagedestroy($im);
            }
        }
        return $base . $nameFile;
    }

    private function hasActive($request)
    {
        $solicitudes = Solicitud::where('persona_id', $request->persona_id)->where('prioridad_id', NULL)->get();
        if (empty($solicitudes[0])) {
            return false;
        }
        return true;
    }

}

