<?php

namespace App\Repositories;

use App\Models\DetailBoutique;
use App\Repositories\BaseRepository;

class DetailBoutiqueRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'produit_boutique',
        'stock',
        'quantite',
        'prix',
        'ttc',
        'boutique'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return DetailBoutique::class;
    }
}
