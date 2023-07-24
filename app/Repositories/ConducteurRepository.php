<?php

namespace App\Repositories;

use App\Models\Conducteur;
use App\Repositories\BaseRepository;

class ConducteurRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'nom',
        'prenom',
        'telephone',
        'quartier',
        'date_naissance',
        'photo',
        'caution',
        'type_piece',
        'numero_piece'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Conducteur::class;
    }
}
