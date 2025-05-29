<?php

namespace App\Repositories;

use App\Models\TypeProduit;
use App\Repositories\BaseRepository;

class TypeProduitRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'libelle'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return TypeProduit::class;
    }
}
