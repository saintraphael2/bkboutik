<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Versement extends Model
{
    public $table = 'versement';

    public $fillable = [
        'contrat',
        'numero_recu',
        'date',
        'montant',
        'reste_payer',
        'arriere',
        'caissier'
    ];

    protected $casts = [
        'numero_recu' => 'string',
        'date' => 'date'
    ];

    public static array $rules = [
        'contrat' => 'required',
       // 'numero_recu' => 'required|string|max:100',
        'date' => 'required',
        'montant' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'reste_payer' => 'nullable',
        'arriere' => 'nullable',
        'caissier' => 'nullable'
    ];

    public function myCaissier(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'caissier');
    }

    public function caissier(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'caissier');
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (!$model->numero_recu) {
                $length = 6;
                $numbers = "";

                $last = Versement::latest('id')->first();
                $id = ($model->id) ? $model->id : (($last) ? ($last->id + 1) : 1);

                for ($i = 0; $i < ($length-strlen($id)); $i++){
                    $numbers .= "0";
                }
                $numbers .= $id;

                $model->numero_recu = strtoupper("VRSM-".$numbers);
            }
        });
    
    }

    public function contrats(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Contrat::class, 'contrat');
    }

    public function tableauArmortissements(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\TableauArmortissement::class, 'versement');
    }
    public function VersementDetail(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\VersementDetail::class, 'versement');
    }
    public function caissiers(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Users::class, 'caissier');
    }
}
