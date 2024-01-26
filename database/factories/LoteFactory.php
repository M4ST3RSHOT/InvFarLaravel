<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\lote>
 */
class LoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'stock'=>fake()->numberBetween($min=1,$max=20),
        'fecha_expiracion'=>fake()->date(),
        'adquiere_id'=>fake()->numberBetween($min=1,$max=40),
        'producto_id'=>fake()->numberBetween($min=1,$max=50),
        ];
    }
}
