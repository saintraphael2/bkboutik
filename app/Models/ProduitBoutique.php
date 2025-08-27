<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProduitBoutique extends Model
{
    public $table = 'produit_boutique';

    public $fillable = [
        'code',
        'libelle',
        'quantite',
        'prix',
        'stock'
    ];

    protected $casts = [
        'code' => 'string',
        'libelle' => 'string'
    ];

    public static array $rules = [
        'code' => 'required|string|max:100',
        'libelle' => 'required|string|max:100',
        'quantite' => 'nullable',
        'prix' => 'nullable',
        'stock' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function stocks(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Stock::class, 'stock');
    }

    public function detailBoutiques(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\DetailBoutique::class, 'produit_boutique');
    }

    public function stock1s(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Stock::class, 'produit_boutique');
    }
}
