<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Souscription extends Model
{
    public $table = 'souscription';

    public $fillable = [
        'produit',
        'date_souscription',
        'client',
        'identification',
        'autre_info',
        'montant_initial',
        'solde',
        'souscripteur'
    ];

    protected $casts = [
        'date_souscription' => 'date',
        'identification' => 'string',
        'autre_info' => 'string'
    ];

    public static array $rules = [
        'produit' => 'nullable',
        'date_souscription' => 'nullable',
        'client' => 'nullable',
        'identification' => 'nullable|string|max:100',
        'autre_info' => 'nullable|string|max:100',
        'montant_initial' => 'nullable',
        'solde' => 'nullable',
        'souscripteur' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function clients(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Contrat::class, 'client');
    }

    public function produits(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Produit::class, 'produit');
    }

    public function facturationProduits(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\FacturationProduit::class, 'souscription');
    }
}
