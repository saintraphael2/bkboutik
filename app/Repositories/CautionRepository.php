<?php

namespace App\Repositories;

use App\Models\Caution;
use App\Repositories\BaseRepository;

class CautionRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'nom',
        'prenom',
        'telephone',
        'quartier',
        'date_naissance',
        'type_piece',
        'numero_piece'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Caution::class;
    }
}
