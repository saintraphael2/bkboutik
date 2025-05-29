<?php

namespace App\Repositories;

use App\Models\Produit;
use App\Repositories\BaseRepository;

class ProduitRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'type_produit',
        'modele',
        'montant'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Produit::class;
    }
}
