<?php

namespace App\Repositories;

use App\Models\Typepiece;
use App\Repositories\BaseRepository;

class TypepieceRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'libelle'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Typepiece::class;
    }
}
