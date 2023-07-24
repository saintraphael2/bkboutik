<?php

namespace App\Repositories;

use App\Models\Tableau_armortissement;
use App\Repositories\BaseRepository;

class Tableau_armortissementRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'datprev',
        'montant',
        'cummul',
        'solde',
        'contrat',
        'etat',
        'datreglement',
        'versement'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Tableau_armortissement::class;
    }
}
