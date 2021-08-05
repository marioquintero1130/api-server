<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    protected $table = 'mvpublicaciones';

    protected $fillable = [
        'descripcion',
        'archivoadjunto',
        'estado_id',
        'usuario_id',
        'publicacion_id',
        'tipopublicacion_id',
        'tipoetiqueta_id',
        
        /*
        'created_by',
        'updated_by',
        'deleted_by'
        */
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
