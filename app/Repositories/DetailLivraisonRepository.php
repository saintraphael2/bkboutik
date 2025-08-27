<?php

namespace App\Repositories;

use App\Models\DetailLivraison;
use App\Repositories\BaseRepository;

class DetailLivraisonRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'livraison',
        'produit_boutique',
        'detail_boutique',
        'quantite'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return DetailLivraison::class;
    }
}
