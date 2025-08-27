<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Boutique extends Model
{
    public $table = 'boutique';

    public $fillable = [
        'code',
        'ttc',
        'caissier',
        'client',
        'montant_verse',
        'relicat'
    ];

    protected $casts = [
        'code' => 'string',
        'client' => 'string'
    ];

    public static array $rules = [
        'code' => 'nullable|string|max:45',
        'ttc' => 'required',
        'client' => 'nullable|string|max:245',
        'montant_verse' => 'nullable',
        'relicat' => 'nullable',
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

                $last = Boutique::latest('id')->first();
                $id = ($model->id) ? $model->id : (($last) ? ($last->id + 1) : 1);

                for ($i = 0; $i < ($length-strlen($id)); $i++){
                    $numbers .= "0";
                }
                $numbers .= $id;

                $model->code = strtoupper("FACT-".$numbers);
            }
        });
    
    }
    public function detailBoutiques(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\DetailBoutique::class, 'boutique');
    }
    public function caissiers(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'caissier');
    }
}
