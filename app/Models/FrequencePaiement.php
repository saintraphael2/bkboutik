<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrequencePaiement extends Model
{
    public $table = 'frequence_paiement';

    public $fillable = [
        'libelle',
        'nb_jours'
    ];

    protected $casts = [
        'libelle' => 'string'
    ];

    public static array $rules = [
        'libelle' => 'required|string|max:191',
        'nb_jours' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
