<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\cliente>
 */
class ClienteFactory extends Factory
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
        $imagen='cliente.jpg';
        $correo=$nombre.'@'.$cuenta;
        return [
        'nombre'=>$nombre,
        'apellido'=>fake()->lastName(),
        'fecha_nacimiento'=>fake()->date(),
        'ci'=>fake()->numberBetween($min=6000000,$max=9999999),
        'correo'=>$correo,
        'telefono'=>fake()->numberBetween($min=60000000,$max=99999999),
        'imagen'=>$imagen,
        ];
    }
}
