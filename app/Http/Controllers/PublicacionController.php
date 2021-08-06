<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use Illuminate\Http\Request;

class PublicacionController extends Controller
{
    // GET publicaciones
    public function index(Request $request)
    {
        if ($request->has('etiqueta_id')) {
            return response()->json([
                'success' => true,
                'message' => 'GET publicaciones successfully',
                'data' => Publicacion::where('etiqueta_id', $request->etiqueta_id)->get()
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'GET publicaciones successfully',
                'data' => Publicacion::all()
            ]);
        }
    }

    // POST publicaciones
    public function store(Request $request)
    {
        $input = $request->all();
        if ($request->has('archivoadjunto') && !empty($request->archivoadjunto)) {
            $input['archivoadjunto'] = $this->loadPhoto($request->archivoadjunto);
        }
        Publicacion::create($input);
        return response()->json([
            'success' => true,
            'message' => 'Publicación creada exitosamente'
        ]);
    }

    // GET publicaciones/id
    public function show($id)
    {
        $publicacion = Publicacion::find($id);
        if (empty($publicacion)) {
            return response()->json([
                'success' => false,
                'message' => 'Publicación no encontrada.',
                'data' => array()
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'GET request successfully',
                'data' => $publicacion
            ]);
        }
    }

    //PUT publicaciones/id
    public function update($id, Request $request)
    {
        $publicacion = Publicacion::find($id);
        if (!empty($publicacion)){
            $input = $request->all();
            if ($request->has('archivoadjunto') && !empty($request->archivoadjunto)) {
                $input['archivoadjunto'] = $this->loadPhoto($request->archivoadjunto);
            }
            $publicacion->update($input);
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
        $publicacion = Publicacion::find($id);
        if (empty($publicacion)) {
            return response()->json([
                'success' => false,
                'message' => 'La solicitud a eliminar no existe.'
            ]);
        } else {
            Publicacion::destroy($id);
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
        $base = 'public/images/posts/';	
		$path = base_path($base) . $nameFile;  
		$im = imagecreatefromstring($data);
		if ($im !== false) {		
			if(imagepng($im, $path)){
				imagedestroy($im);
            }
        }
        return $base . $nameFile;
    }

}
