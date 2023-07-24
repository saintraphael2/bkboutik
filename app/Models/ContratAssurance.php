<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContratAssurance extends Model
{
    public $table = 'contrat_assurance';

    public $fillable = [
        'numero_contrat',
        'compagnie_assurance',
        'moto',
        'date_debut',
        'date_fin'
    ];

    protected $casts = [
        'numero_contrat' => 'string',
        'date_debut' => 'date',
        'date_fin' => 'date'
    ];

    public static array $rules = [
        'numero_contrat' => 'required|string|max:100',
        'compagnie_assurance' => 'required',
        'moto' => 'required',
        'date_debut' => 'required',
        'date_fin' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function compagnieAssurances(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\CompagnieAssurance::class, 'compagnie_assurance');
    }

    public function motos(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Moto::class, 'moto');
    }
}
