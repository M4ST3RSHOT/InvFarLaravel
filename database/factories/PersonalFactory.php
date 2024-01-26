<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\personal>
 */
class PersonalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nombre=fake()->firstName();
        $cuenta=fake()->safeEmailDomain();
        $correo=$nombre.'@'.$cuenta;
        return [
        'nombre'=>$nombre,
        'apellido'=>fake()->lastname(),
        'password'=>fake()->username(),
        'tipo'=>fake()->randomElement(['Administrador','Vendedor','Encargado de Almacenamiento']),
        'fecha_inicio'=>fake()->date(),
        'ci'=>fake()->numberBetween($min=6000000,$max=9999999),
        'correo'=>$correo,
        'direccion'=>fake()->streetAddress(),
        'telefono'=>fake()->numberBetween($min=60000000,$max=99999999),
        'salario'=>fake()->numberBetween($min=2000,$max=2500),
        'farmacia_id'=>'1',
        ];
    }
}
