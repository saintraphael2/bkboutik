<?php

namespace App\Repositories;

use App\Models\Cautions_conduteur;
use App\Repositories\BaseRepository;

class Cautions_conduteurRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'conducteur',
        'caution'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Cautions_conduteur::class;
    }
}
