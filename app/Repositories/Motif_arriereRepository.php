<?php

namespace App\Repositories;

use App\Models\Motif_arriere;
use App\Repositories\BaseRepository;

class Motif_arriereRepository extends BaseRepository
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
        return Motif_arriere::class;
    }
}
