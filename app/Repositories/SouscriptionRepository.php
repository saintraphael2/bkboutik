<?php

namespace App\Repositories;

use App\Models\Souscription;
use App\Repositories\BaseRepository;

class SouscriptionRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'produit',
        'date_souscription',
        'client',
        'identification',
        'autre_info',
        'montant_initial',
        'solde',
        'souscripteur'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Souscription::class;
    }
}
