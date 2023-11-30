<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VersementDetail extends Model
{
    public $table = 'versement_detail';

    public $fillable = [
        'versement',
        'amortissement'
    ];

    protected $casts = [
        
    ];

    public static array $rules = [
        'versement' => 'nullable',
        'amortissement' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function versement(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Versement::class, 'versement');
    }

    public function amortissement(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\TableauArmortissement::class, 'amortissement');
    }
}
