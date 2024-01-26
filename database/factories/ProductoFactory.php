<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'nombre'=>fake()->word(),
        'descripcion'=>fake()->sentence(),
        'unidad'=>fake()->randomElement(['gr','mlgr']),
        'peso'=>fake()->randomFloat(2, 0, 100),
        'categoria_id'=>fake()->numberBetween($min=1,$max=6),
        'precio_compra'=>fake()->randomFloat(2, 1, 100),
        'precio_venta'=>fake()->randomFloat(2, 1, 100),

        ];
    }
}
