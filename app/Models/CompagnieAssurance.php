<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompagnieAssurance extends Model
{
    public $table = 'compagnie_assurance';

    public $fillable = [
        'designation',
        'telephone'
    ];

    protected $casts = [
        'designation' => 'string',
        'telephone' => 'string'
    ];

    public static array $rules = [
        'designation' => 'required|string|max:100',
        'telephone' => 'required|string|max:100',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function contratAssurances(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\ContratAssurance::class, 'compagnie_assurance');
    }
}
