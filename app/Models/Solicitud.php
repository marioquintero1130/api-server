<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table = 'mvsolicitudes';

    protected $fillable = [
        'descripcion',
        'duracionsintomas',
        'tiempo',
        'archivoadjunto',
        'persona_id',
        'prioridad_id',
        'cita_id',
        'puntuacion',       
        'comentario',        
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
