<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    public $table = 'contrat';

    /*
    public $fillable = [
        'typecontrat',
        'numero',
        'moto',
        'conducteur',
        'bdeposit',
        'deposit',
        'montant_total',
        'date_signature',
        'date_debut',
        'date_fin',
        'datprm',
        'observation',
        'montant',
        'solde',
        'journalier',
        'agent',
        'actif'
    ];*/

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    protected $casts = [
        'numero' => 'string',
        'bdeposit' => 'boolean',
        'date_signature' => 'date',
        'date_debut' => 'date',
        'date_fin' => 'date',
        'datprm' => 'date',
        'observation' => 'string',
        'journalier' => 'boolean'
    ];

    public static array $rules = [
        'typecontrat' => 'required',
        //'numero' => 'nullable|string|max:100',
        'moto' => 'required',
        'conducteur' => 'required',
        'bdeposit' => 'nullable|boolean',
        'deposit' => 'nullable',
        'montant_total' => 'required',
        'date_signature' => 'required',
        'date_debut' => 'required',
        'date_fin' => 'required',
        'datprm' => 'nullable',
        'observation' => 'required|string|max:16777215',
        'montant' => 'nullable',
        'solde' => 'nullable',
        'offre' => 'required|integer|exists:offres,id',
        'frequence_paiement' => 'required|integer',
        'journalier' => 'nullable|boolean',
		'motif_arriere' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'agent' => 'nullable',
        'actif' => 'nullable|boolean'
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (!$model->numero) {
                $length = 6;
                $numbers = "";
                $date = now();

                $last = Contrat::latest('id')->first();
                $id = ($model->id) ? $model->id : (($last) ? ($last->id + 1) : 1);

                for ($i = 0; $i < ($length-strlen($id)); $i++){
                    $numbers .= "0";
                }
                $numbers .= $id;

                //$model->numero = strtoupper("CTR-".$date->format('Y').-".$date->format('m')."-".$numbers);
                $model->numero = strtoupper("CTR-".$numbers);
                //$model->numero = strtoupper("CTR-".$numbers."_anoterthing");
            }
        });
    
    }

    public function conducteurs(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Conducteur::class, 'conducteur');
    }

    public function motos(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Moto::class, 'moto');
    }

    public function typecontrats(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\TypeContrat::class, 'typecontrat');
    }

    public function tableauArmortissements(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\TableauArmortissement::class, 'contrat');
    }

    public function versements(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Versement::class, 'contrat');
    }

    public function agent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'agent');
    }
	public function motifArriere(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Motif_arriere::class, 'motif_arriere');
    }

    public function offre(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Offre::class, 'offre');
    }
}
