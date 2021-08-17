<?php

namespace App\Http\Controllers;

use App\Models\Beneficiario;
use Illuminate\Http\Request;

class BeneficiarioController extends Controller
{
    // GET beneficiarios
    public function index(Request $request)
    {
        if ($request->has('usuario_id')) {
            return response()->json([
                'success' => true,
                'message' => 'GET beneficiarios successfully',
                'data' => Beneficiario::where('usuario_id', $request->usuario_id)->get()
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'GET beneficiarios successfully',
                'data' => Beneficiario::all()
            ]);
        }
    }

    // POST beneficiarios
    public function store(Request $request)
    {
        $input = $request->all();
        if ($request->has('archivoadjunto') && !empty($request->archivoadjunto)) {
            $input['archivoadjunto'] = $this->loadPhoto($request->archivoadjunto);
            //TODO: Actualizar la foto de la persona
        }
        Beneficiario::create($input);
        return response()->json([
            'success' => true,
            'message' => 'Beneficiario creado exitosamente'
        ]);
    }

    // GET beneficiarios/id
    public function show($id)
    {
        $publicacion = Beneficiario::find($id);
        if (empty($publicacion)) {
            return response()->json([
                'success' => false,
                'message' => 'Beneficiario no encontrado.',
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

    //PUT beneficiarios/id
    public function update($id, Request $request)
    {
        $publicacion = Beneficiario::find($id);
        if (!empty($publicacion)){
            $input = $request->all();
            if ($request->has('archivoadjunto') && !empty($request->archivoadjunto)) {
                $input['archivoadjunto'] = $this->loadPhoto($request->archivoadjunto);
            }
            $publicacion->update($input);
            return response()->json([
                'success' => true,
                'message' => 'PUT beneficiarios successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No se encontró el beneficiario.'
            ]);
        }
    }
    
    //DELETE beneficiarios/id
    public function delete($id)
    {
        $publicacion = Beneficiario::find($id);
        if (empty($publicacion)) {
            return response()->json([
                'success' => false,
                'message' => 'La solicitud a eliminar no existe.'
            ]);
        } else {
            Beneficiario::destroy($id);
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
			if(imagepng($im, $path, 5)){
				imagedestroy($im);
            }
        }
        return $base . $nameFile;
    }

}
