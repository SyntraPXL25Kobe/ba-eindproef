<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Region;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    public function run(): void
    {
        $regionIds = Region::pluck('id');

        if ($regionIds->isEmpty()) {
            return;
        }

        foreach (range(1, 30) as $i) {
            Address::create([
                'street' => fake()->streetName(),
                'house_number' => (string) fake()->numberBetween(1, 200),
                'postal_code' => (string) fake()->numberBetween(1000, 9999),
                'city' => fake()->city(),
                'region_id' => $regionIds->random(),
            ]);
        }
    }
}
