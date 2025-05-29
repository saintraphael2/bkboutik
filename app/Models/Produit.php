<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    public $table = 'produit';

    public $fillable = [
        'type_produit',
        'modele',
        'montant'
    ];

    protected $casts = [
        'modele' => 'string'
    ];

    public static array $rules = [
        'type_produit' => 'nullable',
        'modele' => 'nullable|string|max:100',
        'montant' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function typeProduit(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\TypeProduit::class, 'type_produit');
    }

    public function souscriptions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Souscription::class, 'produit');
    }
}
