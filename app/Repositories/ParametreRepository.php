<?php

namespace App\Repositories;

use App\Models\Parametre;
use App\Repositories\BaseRepository;

class ParametreRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'nom_societe',
        'adresse_societe',
        'contact_societe',
        'prefixe_contrat',
        'index_contrat',
        'index_recu'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Parametre::class;
    }
}
