<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partenaires extends Model
{
    public $table = 'partenaires';

    public $fillable = [
        'nom',
        'prenom',
        'telephone'
    ];

    protected $casts = [
        'nom' => 'string',
        'prenom' => 'string',
        'telephone' => 'string'
    ];

    public static array $rules = [
        'nom' => 'nullable|string|max:30',
        'prenom' => 'nullable|string|max:30',
        'telephone' => 'nullable|string|max:20',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function motos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Moto::class, 'partenaire');
    }
}
