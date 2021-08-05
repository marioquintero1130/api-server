<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use Illuminate\Http\Request;

class PublicacionController extends Controller
{
    // GET Publicaciones
    public function index(Request $request)
    {
        if ($request->has('term')) {
            return Publicacion::where('description', 'like', '%' . $request->term . '%')->get();
        } else {
            return response()->json(['success' => true, 'message' => 'GET request successfully', 'data' => Publicacion::all()]);
        }
    }
}

