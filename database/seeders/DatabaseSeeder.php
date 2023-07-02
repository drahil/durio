<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Omar Djecevic',
            'email' => 'djecevic.omar@gmail.com',

        ]);

        User::factory(45)->create(); //number of customers
        User::factory(5)       // number of workers
            ->state([
                'role' => 'worker',
            ])
            ->create();
         Service::factory(3)->create();
         Reservation::factory(100)->create();
    }
}
