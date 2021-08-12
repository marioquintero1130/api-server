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
        'etiqueta_id',
        'created_by',
        'created_at',
    ];

    protected $hidden = [
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by'];
}
