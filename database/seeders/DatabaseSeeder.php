<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolePermissionSeeder::class);
        $this->call(CompanySeeder::class);

        $adminUser = User::factory()->create([
            'name' => 'Admin Test User',
            'email' => 'admin.test@example.com',
            'password' => bcrypt('password'),
        ]);

        $studentUser = User::factory()->create([
            'name' => 'Student Test User',
            'email' => 'student.test@example.com',
            'password' => bcrypt('password'),
        ]);

        $professionalTestUser = User::factory()->create([
            'name' => 'Professional Test User',
            'email' => 'professional.test@example.com',
            'password' => bcrypt('password'),
        ]);

        $adminUser->assignRole('admin');
        $studentUser->assignRole('student');
        $professionalTestUser->assignRole('professional');
    }
}
