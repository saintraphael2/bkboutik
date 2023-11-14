<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    public $table = 'users';

    public $fillable = [
        'name',
        'comptable',
        'email',
        'password',
    ];

    protected $casts = [
        
    ];

    public static array $rules = [
        
    ];

    
}
