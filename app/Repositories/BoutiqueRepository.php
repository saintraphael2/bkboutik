<?php

namespace App\Repositories;

use App\Models\Boutique;
use App\Repositories\BaseRepository;

class BoutiqueRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'produit_boutique',
        'stock',
        'quantite',
        'prix',
        'ttc',
        'caissier'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Boutique::class;
    }
}
