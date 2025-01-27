<?php

namespace App\Repositories;

use App\Models\FrequencePaiement;
use App\Repositories\BaseRepository;

class FrequencePaiementRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'libelle',
        'nb_jours'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return FrequencePaiement::class;
    }
}
