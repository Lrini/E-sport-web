<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PesertaFactory extends Factory
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
            'nama_sekolah' => $this->faker->company(),
            'penanggung_jawab' => $this->faker->name(),
            'id_lomba' => 1,
            'no_hp' => $this->faker->phoneNumber(),
        ];
    }
}
