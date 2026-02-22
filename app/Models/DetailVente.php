<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailVente extends Model
{
    public $table = 'detail_vente';

    public $fillable = [
        'produit_boutique',
        'stock',
        'quantite',
        'prix',
        'ttc',
        'vente'
    ];

    protected $casts = [
        
    ];

    public static array $rules = [
        'produit_boutique' => 'required',
        'stock' => 'required',
        'quantite' => 'required',
        'prix' => 'required',
        'ttc' => 'required',
        'vente' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function produitBoutique(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\ProduitBoutique::class, 'produit_boutique');
    }

    public function stock(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Stock::class, 'stock');
    }

    public function vente(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Vente::class, 'vente');
    }
}
