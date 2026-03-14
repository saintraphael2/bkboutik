<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depot extends Model
{
    public $table = 'depot';

    public $fillable = [
        'code',
        'montant',
        'caissier',
        'client'
    ];

    protected $casts = [
        'code' => 'string'
    ];

    public static array $rules = [
        'code' => 'nullable|string|max:45',
        'montant' => 'required',
         
        'client' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (!$model->numero_recu) {
                $length = 6;
                $numbers = "";

                $last = Depot::latest('id')->first();
                $id = ($model->id) ? $model->id : (($last) ? ($last->id + 1) : 1);

                for ($i = 0; $i < ($length-strlen($id)); $i++){
                    $numbers .= "0";
                }
                $numbers .= $id;

                $model->code = strtoupper("RGT-".$numbers);
            }
        });
    
    }
    public function clients(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Client::class, 'client');
    }

    public function caissiers(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'caissier');
    }
}
