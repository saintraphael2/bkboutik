<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tableau_armortissement extends Model
{
    public $table = 'tableau_armortissement';

    public $fillable = [
        'datprev',
        'montant',
        'cummul',
        'solde',
        'contrat',
        'etat',
        'datreglement',
        'versement'
    ];

    protected $casts = [
        'datprev' => 'date',
        'etat' => 'string',
        'datreglement' => 'date'
    ];

    public static array $rules = [
        'datprev' => 'nullable',
        'montant' => 'nullable',
        'cummul' => 'nullable',
        'solde' => 'nullable',
        'contrat' => 'nullable',
        'etat' => 'nullable|string',
        'datreglement' => 'nullable',
        'versement' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function contrat(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Contrat::class, 'contrat');
    }

    public function versement(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Versement::class, 'versement');
    }
}
