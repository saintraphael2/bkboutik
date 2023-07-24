<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cautions_conduteur extends Model
{
    public $table = 'cautions_conduteur';

    public $fillable = [
        'conducteur',
        'caution'
    ];

    protected $casts = [
        
    ];

    public static array $rules = [
        'conducteur' => 'required',
        'caution' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function cautions(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Caution::class, 'caution');
    }

    public function conducteur(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Conducteur::class, 'conducteur');
    }
}
