<?php

namespace App\Repositories;

use App\Models\Vidange;
use App\Repositories\BaseRepository;

class VidangeRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'moto',
        'date',
        'kilometrage',
        'prochaine'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Vidange::class;
    }
}
