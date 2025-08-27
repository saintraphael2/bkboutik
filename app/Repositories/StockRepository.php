<?php

namespace App\Repositories;

use App\Models\Stock;
use App\Repositories\BaseRepository;

class StockRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'produit_boutique',
        'date_stock',
        'quantite',
        'prix',
        'magasinier'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Stock::class;
    }
}
