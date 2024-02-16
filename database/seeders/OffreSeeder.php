<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OffreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $entities = [
            [
                'nom' => "OFFRE : 01 LOCATION-VENTE (LEASING) DE 18 MOIS / 1.050.400 FRS",
                'tarif_journalier' => 2200,
                'tarif_hebdomadaire' => 13200,
                'tarif_mensuel' => 57200
            ],
            [
                'nom' => "OFFRE : 02 LOCATION-VENTE (LEASING) DE 12 MOIS / 900.000 FRS",
                'tarif_journalier' => 2885,
                'tarif_hebdomadaire' => 17310,
                'tarif_mensuel' => 75000
            ],
            [
                'nom' => "OFFRE : 03 LOCATION-VENTE (LEASING) DE 06 MOIS / 803.400 FRS",
                'tarif_journalier' => 5150,
                'tarif_hebdomadaire' => 30200,
                'tarif_mensuel' => 133900
            ]
        ];

        foreach ($entities as $key => $value) {
            $entity = \App\Models\Offre::create($value);
        }
    }
}
