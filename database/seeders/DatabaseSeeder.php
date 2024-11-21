<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Device;
use App\Models\Access;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create 10 fake users
        \App\Models\User::factory(10)->create();

        // Create 5 fake devices
        \App\Models\Device::factory(5)->create();

        // Create random access entries for each user to random devices
        \App\Models\Access::factory(20)->create();
    }
}
