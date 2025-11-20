<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AcaraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
             'uuid' => $this->faker->unique()->numberBetween(1, 1000000),
            'id_lomba' => 1,
            'tanggal_acara' => $this->faker->date(),
            'keterangan' => $this->faker->sentence(),
        ];
    }
}
