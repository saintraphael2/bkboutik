<?php

namespace App\Repositories;

use App\Models\User_liens;
use App\Repositories\BaseRepository;

class User_liensRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'lien',
        'user',
        'update_at'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return User_liens::class;
    }
}
