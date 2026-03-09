<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    public $table = 'vente';

    public $fillable = [
        'code',
        'ttc',
        'caissier',
        'client'
    ];

    protected $casts = [
        'code' => 'string'
    ];

    public static array $rules = [
        'code' => 'nullable|string|max:45',
      
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

                $last = Vente::latest('id')->first();
                $id = ($model->id) ? $model->id : (($last) ? ($last->id + 1) : 1);

                for ($i = 0; $i < ($length-strlen($id)); $i++){
                    $numbers .= "0";
                }
                $numbers .= $id;

                $model->code = strtoupper("ENT-".$numbers);
            }
        });
    
    }
    public function caissierS(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'caissier');
    }

     public function clients(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Client::class, 'client');
    }
    public function detailVentes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\DetailVente::class, 'vente');
    }

    public function livraisons(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Livraison::class, 'vente');
    }
}
