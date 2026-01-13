<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    public $table = 'stock';

    public $fillable = [
        'produit_boutique',
        'date_stock',
        'quantite',
        'prix',
        'magasinier',
        'qte_init',
        'qte_livree',
        'qte_payee',
        'prix_entreprise',
        'existant',
        'quantite_ajoute'
    ];

    protected $casts = [
        'date_stock' => 'date'
    ];

    public static array $rules = [
        'produit_boutique' => 'required',
        'date_stock' => 'required',
        'quantite' => 'required',
        'prix' => 'nullable',
        'magasinier' => 'nullable',
        'qte_init' => 'nullable',
        'qte_livree' => 'nullable',
        'qte_payee' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'prix_entreprise' => 'nullable',
        'existant' => 'nullable',
        'quantite_ajoute' => 'nullable'
    ];

    public function magasinier(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'magasinier');
    }

    public function produitBoutique(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\ProduitBoutique::class, 'produit_boutique');
    }

    public function detailBoutiques(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\DetailBoutique::class, 'stock');
    }

    public function produitBoutique1s(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\ProduitBoutique::class, 'stock');
    }
}
