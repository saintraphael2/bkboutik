<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Moto extends Model
{
    public $table = 'moto';

    public $fillable = [
        'immatriculation',
        'chassis',
        'mise_circulation',
        'disponible',
        'prochaine_vidange',
        'date_enregistrement'
    ];

    protected $casts = [
        'immatriculation' => 'string',
        'chassis' => 'string',
        'mise_circulation' => 'string',
        'disponible' => 'boolean',
        'prochaine_vidange' => 'date',
        'date_enregistrement' => 'date'
    ];

    public static array $rules = [
        //'immatriculation' => 'required|string|max:100',
        //'immatriculation' => 'required|regex:/^[A-Z]{2}-[0-9]{4}-[A-Z]{2}$/',
        'immatriculation' => 'required|regex:/^TG-[0-9]{4}-[A-Z]{2}$/',
        'chassis' => 'required|string|max:100',
        'mise_circulation' => 'required|string|max:10',
        'disponible' => 'required|boolean',
        'prochaine_vidange' => 'nullable',
        'date_enregistrement' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function mycontrat(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Contrat::class, 'moto');
    }

    public function contrats(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Contrat::class, 'moto');
    }

    public function contratAssurances(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\ContratAssurance::class, 'moto');
    }

    public function vidanges(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Vidange::class, 'moto');
    }
}
