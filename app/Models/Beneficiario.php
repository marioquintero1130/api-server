<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Beneficiario extends Model
{
    protected $table = 'mvbeneficiarios';

    protected $fillable = [
        'estado_id',
        'persona_id',        
        'usuario_id',        
        
        /*
        'created_by',
        'updated_by',
        'deleted_by'
        */
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
