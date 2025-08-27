<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    public $table = 'livraison';

    public $fillable = [
        'boutique',
        'magasinier'
    ];

    protected $casts = [
        
    ];

    public static array $rules = [
        'boutique' => 'nullable',
       
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function boutiques(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Boutique::class, 'boutique');
    }

    public function magasiniers(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'magasinier');
    }

    public function detailLivraisons(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\DetailLivraison::class, 'livraison');
    }
}
