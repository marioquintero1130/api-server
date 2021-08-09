<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Reaccion extends Model
{
    protected $table = 'mvreaciones';

    protected $fillable = [
        'usuario_id',
        'publicacion_id',        
        'tiporeacion_id',        
        
        /*
        'created_by',
        'updated_by',
        'deleted_by'
        */
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
