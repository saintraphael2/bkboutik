<?php

namespace App\Repositories;

use App\Models\DetailVente;
use App\Repositories\BaseRepository;

class DetailVenteRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'produit_boutique',
        'stock',
        'quantite',
        'prix',
        'ttc',
        'vente'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return DetailVente::class;
    }
}
