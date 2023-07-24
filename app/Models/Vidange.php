<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vidange extends Model
{
    public $table = 'vidange';

    public $fillable = [
        'moto',
        'date',
        'kilometrage',
        'prochaine'
    ];

    protected $casts = [
        'date' => 'date',
        'prochaine' => 'date'
    ];

    public static array $rules = [
        'moto' => 'required',
        'date' => 'required',
        'kilometrage' => 'required',
        'prochaine' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function motos(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Moto::class, 'moto');
    }
}
