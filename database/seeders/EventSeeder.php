<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        Event::factory()->count(15)->create();
        Event::factory()->count(4)->draft()->create();
        Event::factory()->count(3)->cancelled()->create();
    }
}
