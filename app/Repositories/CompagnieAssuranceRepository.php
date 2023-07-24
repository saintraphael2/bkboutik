<?php

namespace App\Repositories;

use App\Models\CompagnieAssurance;
use App\Repositories\BaseRepository;

class CompagnieAssuranceRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'designation',
        'telephone'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return CompagnieAssurance::class;
    }
}
