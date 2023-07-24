<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_liens extends Model
{
    public $table = 'user_liens';

    public $fillable = [
        'lien',
        'user',
        'update_at'
    ];

    protected $casts = [
        'update_at' => 'datetime'
    ];

    public static array $rules = [
        'lien' => 'nullable',
        'user' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function lien(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Lien::class, 'lien');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'user');
    }
    public function getRight($user){
        $dateLimite= date('Y-m-d',mktime(0, 0, 0, date("m"), date("d"),   date("Y")));
        return $this::select(['route'])->where('user',$user)
                           ->Join('liens', 'liens.id', '=', 'user_liens.lien')
                              ->get();

    }
}
