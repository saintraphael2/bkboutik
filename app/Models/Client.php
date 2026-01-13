<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $table = 'client';

    public $fillable = [
        'raison_sociale',
        'responsable',
        'contact',
        'adresse'
    ];

    protected $casts = [
        'raison_sociale' => 'string',
        'responsable' => 'string',
        'contact' => 'string',
        'adresse' => 'string'
    ];

    public static array $rules = [
        'raison_sociale' => 'required|string|max:100',
        'responsable' => 'required|string|max:100',
        'contact' => 'required|string|max:100',
        'adresse' => 'required|string|max:100',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    
}
