<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    public $table = 'vente';

    public $fillable = [
        'code',
        'ttc',
        'caissier',
        'client'
    ];

    protected $casts = [
        'code' => 'string'
    ];

    public static array $rules = [
        'code' => 'nullable|string|max:45',
        'ttc' => 'required',
        'caissier' => 'required',
        'client' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function caissier(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'caissier');
    }

    public function detailVentes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\DetailVente::class, 'vente');
    }

    public function livraisons(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Livraison::class, 'vente');
    }
}
