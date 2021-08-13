<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';

    protected $fillable = [
        'identificacion',
        'direccion',        
        'telefonomovil',
        'email',
        'fechanacimiento',
        'sexo_id',
        'nombre',
        'segundonombre',
        'apellido',
        'segundoapellido',        
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
