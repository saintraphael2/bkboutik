<?php

namespace App\Repositories;

use App\Models\Moto;
use App\Repositories\BaseRepository;

class MotoRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'immatriculation',
        'chassis',
        'mise_circulation',
        'disponible',
        'partenaire'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Moto::class;
    }
}
