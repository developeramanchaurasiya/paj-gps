<?php

namespace Database\Factories;

use App\Models\Access;
use App\Models\User;
use App\Models\Device;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccessFactory extends Factory
{
    protected $model = Access::class;

    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id, // Get a random user
            'device_id' => Device::inRandomOrder()->first()->id, // Get a random device
        ];
    }
}
