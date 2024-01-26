<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\detalle>
 */
class DetalleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'producto_id'=>fake()->numberBetween($min=1,$max=50),
        'cantidad'=>fake()->numberBetween($min=1,$max=20),
        'factura_id'=>fake()->numberBetween($min=1,$max=20),

        ];
    }
}
