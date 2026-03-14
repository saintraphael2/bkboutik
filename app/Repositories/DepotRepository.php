<?php

namespace App\Repositories;

use App\Models\Depot;
use App\Repositories\BaseRepository;

class DepotRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'code',
        'montant',
        'caissier',
        'client'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Depot::class;
    }
}
