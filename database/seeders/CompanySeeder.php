<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Seed the companies table with a spread across all statuses.
     */
    public function run(): void
    {
        Company::factory()->count(8)->create();
        Company::factory()->count(6)->approved()->create();
        Company::factory()->count(3)->rejected()->create();
        Company::factory()->count(2)->blocked()->create();
    }
}