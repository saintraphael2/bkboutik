<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    public $table = 'offres';

    public $fillable = [
        'nom',
        'tarif_journalier',
        'tarif_hebdomadaire',
        'tarif_mensuel'
    ];

    protected $casts = [
        'nom' => 'string'
    ];

    public static array $rules = [
        'nom' => 'nullable|string|max:191',
        'tarif_journalier' => 'nullable',
        'tarif_hebdomadaire' => 'nullable',
        'tarif_mensuel' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
