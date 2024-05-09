<?php

namespace App\Repositories;

use App\Models\Partenaires;
use App\Repositories\BaseRepository;

class PartenairesRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'nom',
        'prenom',
        'telephone'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Partenaires::class;
    }
}
