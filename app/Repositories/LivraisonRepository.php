<?php

namespace App\Repositories;

use App\Models\Livraison;
use App\Repositories\BaseRepository;

class LivraisonRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'boutique',
        'magasinier'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Livraison::class;
    }
}
