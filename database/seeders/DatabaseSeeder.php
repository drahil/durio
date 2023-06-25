<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\Worker;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         Worker::factory(5)->create();
         Customer::factory(10)->create();
         Service::factory(3)->create();
         Reservation::factory(30)->create();
    }
}
