<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LombaFactory extends Factory
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
            'nama_lomba' => $this->faker->word(),
            'deskripsi_lomba' => $this->faker->sentence(),
            'biaya_daftar' => $this->faker->numberBetween(50000, 200000),
        ];
    }
}
