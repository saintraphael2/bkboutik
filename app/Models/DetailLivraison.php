<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailLivraison extends Model
{
    public $table = 'detail_livraison';

    public $fillable = [
        'livraison',
        'produit_boutique',
        'detail_boutique',
        'quantite'
    ];

    protected $casts = [
        
    ];

    public static array $rules = [
        'livraison' => 'nullable',
        'produit_boutique' => 'nullable',
        'detail_boutique' => 'required',
        'quantite' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function detailBoutique(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\DetailBoutique::class, 'detail_boutique');
    }

    public function livraison(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Livraison::class, 'livraison');
    }

    public function produitBoutique(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Boutique::class, 'produit_boutique');
    }
}
