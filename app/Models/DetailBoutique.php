<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailBoutique extends Model
{
    public $table = 'detail_boutique';

    public $fillable = [
        'produit_boutique',
        'stock',
        'quantite',
        'prix',
        'ttc',
        'boutique'
    ];

    protected $casts = [
        
    ];

    public static array $rules = [
        'produit_boutique' => 'required',
        'stock' => 'required',
        'quantite' => 'required',
        'prix' => 'required',
        'ttc' => 'required',
        'boutique' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function boutiques(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Boutique::class, 'boutique');
    }

    public function produitBoutique(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\ProduitBoutique::class, 'produit_boutique');
    }

    public function stock(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Stock::class, 'stock');
    }
}
