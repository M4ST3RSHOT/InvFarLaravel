<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\factura>
 */
class FacturaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $descuento=fake()->randomFloat(2,0,1);
        $subtotal=fake()->numberBetween($min=100,$max=200);
        $total=$subtotal-($subtotal*$descuento);
        return [
        'fecha'=>fake()->date(),
        'subtotal'=>$subtotal,
        'descuento'=>$descuento,
        'total'=>$total,
        'personal_id'=>fake()->numberBetween($min=1,$max=2),
        'cliente_id'=>fake()->numberBetween($min=1,$max=20),

        ];
    }
}
