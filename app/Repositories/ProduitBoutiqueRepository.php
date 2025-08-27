<?php

namespace App\Repositories;

use App\Models\ProduitBoutique;
use App\Repositories\BaseRepository;

class ProduitBoutiqueRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'code',
        'libelle',
        'quantite',
        'prix',
        'stock'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ProduitBoutique::class;
    }
}
