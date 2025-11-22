<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PenontonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
             'uuid' => $this->faker->unique()->numberBetween(1, 1000000), # numberbetweeen digunakan untuk menghindari duplikat
            'nama_lengkap' => $this->faker->name(),
            'asal_sekolah' => $this->faker->company(),
            'id_lomba' => 1,
            'id_acara' => 1,
            'no_hp' => $this->faker->numerify('08##########'),
        ];
    }
}
