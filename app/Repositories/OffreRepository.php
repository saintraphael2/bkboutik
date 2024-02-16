<?php

namespace App\Repositories;

use App\Models\Offre;
use App\Repositories\BaseRepository;

class OffreRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'nom',
        'tarif_journalier',
        'tarif_hebdomadaire',
        'tarif_mensuel'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Offre::class;
    }
}
