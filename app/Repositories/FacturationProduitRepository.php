<?php

namespace App\Repositories;

use App\Models\FacturationProduit;
use App\Repositories\BaseRepository;

class FacturationProduitRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'souscription',
        'montant_a_payer',
        'montant_paye',
        'reste_paye',
        'caissier'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return FacturationProduit::class;
    }
}
