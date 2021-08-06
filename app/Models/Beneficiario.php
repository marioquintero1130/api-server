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
        'created_at',
        'created_by',
    ];

    protected $hidden = [
        'updated_at',
        'deleted_at',
        'updated_by',
        'deleted_by'
    ];
}
