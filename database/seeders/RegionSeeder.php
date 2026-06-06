<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    public function run(): void
    {
        $regions = [
            'Antwerpen',
            'Limburg',
            'Oost-Vlaanderen',
            'West-Vlaanderen',
            'Vlaams-Brabant',
            'Waals-Brabant',
            'Henegouwen',
            'Luik',
            'Luxemburg',
            'Namen',
            'Brussel',
        ];

        foreach ($regions as $name) {
            Region::firstOrCreate(
                ['country_code' => 'BE', 'name' => $name],
            );
        }
    }
}
