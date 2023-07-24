<?php

namespace App\Repositories;

use App\Models\TypeContrat;
use App\Repositories\BaseRepository;

class TypeContratRepository extends BaseRepository
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
        return TypeContrat::class;
    }
}
