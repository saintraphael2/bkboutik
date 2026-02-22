<?php

namespace App\Repositories;

use App\Models\Vente;
use App\Repositories\BaseRepository;

class VenteRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'code',
        'ttc',
        'caissier',
        'client'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Vente::class;
    }
}
