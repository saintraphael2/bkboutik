<?php

namespace App\Repositories;

use App\Models\ContratAssurance;
use App\Repositories\BaseRepository;

class ContratAssuranceRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'numero_contrat',
        'compagnie_assurance',
        'moto',
        'date_debut',
        'date_fin'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ContratAssurance::class;
    }
}
