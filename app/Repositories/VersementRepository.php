<?php

namespace App\Repositories;

use App\Models\Versement;
use App\Repositories\BaseRepository;

class VersementRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'contrat',
        'numero_recu',
        'date',
        'montant',
        'reste_payer'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Versement::class;
    }

    public function generateNumeroRecu(): string
    {
        $length = 6;
        $numbers = "";

        $last = Versement::latest('id')->first();
        $id = ($last) ? ($last->id + 1) : 1;

        for ($i = 0; $i < ($length-strlen($id)); $i++){
            $numbers .= "0";
        }
        $numbers .= $id;

        return strtoupper("VRSM-".$numbers);
    }
}
