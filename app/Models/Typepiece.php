<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Typepiece extends Model
{
    public $table = 'type_piece';

    public $fillable = [
        'libelle'
    ];

    protected $casts = [
        'libelle' => 'string'
    ];

    public static array $rules = [
        'libelle' => 'required|string|max:100',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function cautions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Caution::class, 'type_piece');
    }

    public function conducteurs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Conducteur::class, 'type_piece');
    }
}
