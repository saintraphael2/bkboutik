<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caution extends Model
{
    public $table = 'caution';

    public $fillable = [
        'nom',
        'prenom',
        'telephone',
        'quartier',
        'date_naissance',
        'type_piece',
        'numero_piece'
    ];

    protected $casts = [
        'nom' => 'string',
        'prenom' => 'string',
        'telephone' => 'string',
        'quartier' => 'string',
        'date_naissance' => 'date',
        'numero_piece' => 'string'
    ];

    public static array $rules = [
        'nom' => 'required|string|max:100',
        'prenom' => 'required|string|max:100',
        'telephone' => 'required|string|max:100',
        'quartier' => 'required|string|max:200',
        'date_naissance' => 'required',
        'type_piece' => 'required',
        'numero_piece' => 'required|string|max:100',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function typePiece(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\TypePiece::class, 'type_piece');
    }

    public function cautionsConduteurs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\CautionsConduteur::class, 'caution');
    }
}
