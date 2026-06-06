<?php

namespace Database\Factories;

use App\Enums\EventStatus;
use App\Models\Company;
use App\Models\Event;
use App\Models\EventType;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        $start = fake()->dateTimeBetween('now', '+1 year');
        $end = (clone $start)->modify('+'.fake()->numberBetween(1, 6).' hours');
        $isOnline = fake()->boolean(30);

        return [
            'company_id' => Company::inRandomOrder()->first()?->id,
            'event_type_id' => EventType::inRandomOrder()->first()?->id,
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'start_time' => $start,
            'end_time' => $end,
            'is_online' => $isOnline,
            'online_url' => $isOnline ? fake()->url() : null,
            'address_id' => null,
            'status' => EventStatus::PUBLISHED,
        ];
    }

    public function draft(): static
    {
        return $this->state(fn (array $attributes): array => [
            'status' => EventStatus::DRAFT,
        ]);
    }

    public function cancelled(): static
    {
        return $this->state(fn (array $attributes): array => [
            'status' => EventStatus::CANCELLED,
        ]);
    }
}
