<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Formato>
 */
class FormatoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //'descripcion'=> Str::random(10),
           // 'url'=> Str::random(50),
           //'descripcion' => fake()->name,
           //'url' => fake()->url,
        ];
    }
}
