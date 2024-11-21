<?php

namespace Database\Factories;

use App\Models\Device;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeviceFactory extends Factory
{
    protected $model = Device::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'model' => $this->faker->word,
            'device_unique_id' => $this->faker->unique()->uuid,
        ];
    }
}