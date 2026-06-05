<?php

namespace Database\Factories;

use App\Enums\CompanyStatus;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Company>
 */
class CompanyFactory extends Factory
{
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $displayName = fake()->unique()->company();

        return [
            'legal_name' => $displayName.' '.fake()->randomElement(['NV', 'BV', 'CommV', 'VZW']),
            'display_name' => $displayName,
            'description' => fake()->paragraph(),
            'website_url' => fake()->url(),
            'logo_url' => null,
            'email' => fake()->companyEmail(),
            'phone' => fake()->numerify('+32 ## ## ## ##'),
            'status' => CompanyStatus::Pending,
        ];
    }

    /**
     * Indicate that the company is approved.
     */
    public function approved(): static
    {
        return $this->state(fn (array $attributes): array => [
            'status' => CompanyStatus::Approved,
        ]);
    }

    /**
     * Indicate that the company is rejected.
     */
    public function rejected(): static
    {
        return $this->state(fn (array $attributes): array => [
            'status' => CompanyStatus::Rejected,
        ]);
    }

    /**
     * Indicate that the company is blocked.
     */
    public function blocked(): static
    {
        return $this->state(fn (array $attributes): array => [
            'status' => CompanyStatus::Blocked,
        ]);
    }
}
