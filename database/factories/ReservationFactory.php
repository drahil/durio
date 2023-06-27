<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Service;
use App\Models\Worker;
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
            'date' => $this->faker->dateTimeInInterval('-365 days', '+730 days'),
            'worker_id' => Worker::all()->random()->id,
            'customer_id' => Customer::all()->random()->id,
            'service_id' => Service::all()->random()->id,
        ];
    }
}
