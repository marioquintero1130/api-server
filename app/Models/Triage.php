<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Triage extends Model
{
    protected $table = 'mvtriages';

    protected $fillable = [
        'respiraciondificultuosa',
        'ciudad',
        'confusion',
        'dolorpecho',
        'dolorcabeza',
        'sangradoprofundo',
        'heridaprofunda',
        'sangradoprolongado',       
        'sangreoculta',
        'puedecaminar',
        'puedecomer',
        'vomito',
        'frecuenciavomito',
        'fiebre',
        'sintomasprolongados',
        'enfermedades',
        'medicamentos',       
        'tomadesignos',
        'fechacontactoestrecho',
        'tos',
        'odinofagia',
        'fatiga',
        'perdidaolfacto',
        'diarrea',
        'dolormuscular',       
        'anorexia',
        'delirio',
        'enfermedadpulmonar',
        'enfermedadcardiaca',
        'defensascomprometidas',
        'diabetes',
        'hipertension',
        'enfermedadrenal',       
        'enfermedadhepatica',
        'hogargeriatrico',
        'candidatoprueba',
        'solicitud_id',          
        'comentario',
        
            
        
        /*
        'created_by',
        'updated_by',
        'deleted_by'
        */
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
