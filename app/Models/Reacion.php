<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Reacion extends Model
{
    protected $table = 'mvreaciones';

    protected $fillable = [
        'estado_id',
        'publicaciones_id',        
        'tiporeacion_id',        
        
        /*
        'created_by',
        'updated_by',
        'deleted_by'
        */
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
