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
            'name' =>$this->faker->name,
            'email' => $this->faker->safeEmail,
            'date' => $this->faker->unique()->dateTimeInInterval('-365 days', '+730 days'),
            'user_id' => User::all()->random()->id,
            'service_id' => Service::all()->random()->id,
        ];
    }
}
