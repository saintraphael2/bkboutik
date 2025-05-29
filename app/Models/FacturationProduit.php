<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacturationProduit extends Model
{
    public $table = 'facturation_produit';

    public $fillable = [
        'souscription',
        'montant_a_payer',
        'montant_paye',
        'reste_paye',
        'caissier',
        'code'
    ];

    protected $casts = [
        
    ];

    public static array $rules = [
        'souscription' => 'nullable',
        'montant_a_payer' => 'nullable',
        'montant_paye' => 'nullable',
        'reste_paye' => 'nullable',
        'caissier' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function souscriptions(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Souscription::class, 'souscription');
    }
    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (!$model->code) {
                $length = 6;
                $numbers = "";

                $last = FacturationProduit::latest('id')->first();
                $id = ($model->id) ? $model->id : (($last) ? ($last->id + 1) : 1);

                for ($i = 0; $i < ($length-strlen($id)); $i++){
                    $numbers .= "0";
                }
                $numbers .= $id;

                $model->code = strtoupper("FACTP-".$numbers);
            }
        });
    
    }
    public function caissiers(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Users::class, 'caissier');
    }
}
