<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\adquiere>
 */
class AdquiereFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'proveedor_id'=>fake()->numberBetween($min=1,$max=2),
        'fecha'=>fake()->date(),
        'montototal'=>fake()->numberBetween($min=1000,$max=2000),
        'personal_id'=>fake()->numberBetween($min=1,$max=2),
        ];

    }
}
