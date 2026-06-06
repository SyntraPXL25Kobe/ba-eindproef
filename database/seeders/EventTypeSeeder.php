<?php

namespace Database\Seeders;

use App\Models\EventType;
use Illuminate\Database\Seeder;

class EventTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['code' => 'job_fair', 'name' => 'Job fair'],
            ['code' => 'workshop', 'name' => 'Workshop'],
            ['code' => 'company_visit', 'name' => 'Company visit'],
            ['code' => 'info_session', 'name' => 'Info session'],
            ['code' => 'networking', 'name' => 'Networking event'],
            ['code' => 'webinar', 'name' => 'Webinar'],
            ['code' => 'guest_lecture', 'name' => 'Guest lecture'],
            ['code' => 'recruitment', 'name' => 'Recruitment day'],
            ['code' => 'internship_fair', 'name' => 'Internship fair'],
            ['code' => 'open_day', 'name' => 'Open day'],
        ];

        foreach ($types as $type) {
            EventType::firstOrCreate(['code' => $type['code']], ['name' => $type['name']]);
        }
    }
}
