<?php

namespace Database\Seeders;

use App\Models\Sector;
use Illuminate\Database\Seeder;

class SectorSeeder extends Seeder
{
    public function run(): void
    {
        $sectors = [
            ['code' => 'it', 'name' => 'IT & Software'],
            ['code' => 'engineering', 'name' => 'Engineering'],
            ['code' => 'healthcare', 'name' => 'Healthcare'],
            ['code' => 'finance', 'name' => 'Finance & Banking'],
            ['code' => 'education', 'name' => 'Education'],
            ['code' => 'retail', 'name' => 'Retail'],
            ['code' => 'logistics', 'name' => 'Logistics & Transport'],
            ['code' => 'construction', 'name' => 'Construction'],
            ['code' => 'hospitality', 'name' => 'Hospitality & Tourism'],
            ['code' => 'marketing', 'name' => 'Marketing & Communication'],
            ['code' => 'manufacturing', 'name' => 'Manufacturing'],
            ['code' => 'legal', 'name' => 'Legal'],
        ];

        foreach ($sectors as $sector) {
            Sector::firstOrCreate(['code' => $sector['code']], ['name' => $sector['name']]);
        }
    }
}
