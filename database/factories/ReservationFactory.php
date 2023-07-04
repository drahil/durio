<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'date' => $this->faker->dateTimeBetween('-365 days', '+730 days')->format('Y-m-d'),
            'time' => $this->faker->time('H:i'),
            'worker_id' => User::where('role', '=', 'worker')->get()->random()->id,
            'service_id' => Service::all()->random()->id,
        ];
    }
}
