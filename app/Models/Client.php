<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $table = 'client';

    public $fillable = [
        'nom_client',
        'telephone',
        'solde'
    ];

    protected $casts = [
        'telephone' => 'string'
    ];

    public static array $rules = [
        'nom_client' => 'required',
        'telephone' => 'nullable|string|max:45',
        'solde' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    
}
