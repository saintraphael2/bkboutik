<?php

namespace App\Repositories;

use App\Models\Contrat;
use App\Repositories\BaseRepository;

class ContratRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'typecontrat',
        'numero',
        'moto',
        'conducteur',
        'offre',
        'frequence_paiement',
        'bdeposit',
        'deposit',
        'montant_total',
        'date_signature',
        'date_debut',
        'date_fin',
        'datprm',
        'observation',
        'montant'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Contrat::class;
    }
}
