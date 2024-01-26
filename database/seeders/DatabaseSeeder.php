<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\farmacia;
use App\Models\proveedor;
use App\Models\categoria;
use App\Models\personal;
use App\Models\producto;
use App\Models\adquiere;
use App\Models\lote;
use App\Models\factura;
use App\Models\detalle;
use App\Models\cliente;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        farmacia::create(array(
            'nit'=>'76133846',
            'nombre'=>'SuperFarma',
            'direccion'=>'Adolfo Mier , Potosi y Bolivar',
            'telefono'=>'76133846',
        ));

        proveedor::factory(10)->create();

        categoria::create(array('nombre'=>'Pildoras'));
        categoria::create(array('nombre'=>'Inyectable'));
        categoria::create(array('nombre'=>'Suero'));
        categoria::create(array('nombre'=>'Crema'));
        categoria::create(array('nombre'=>'Golosina'));
        categoria::create(array('nombre'=>'Medicamento'));

        // personal::factory(5)->create();

        personal::create(array(
            'nombre'=>'yamil',
            'apellido'=>'aguirre',
            'password'=>'yamilito123',
            'tipo'=>'administrador',
            'fecha_inicio'=>'1999-03-03',
            'ci'=>'76133846',
            'correo'=>'yamilito123@gmail.com',
            'direccion'=>'bolivar y potosi',
            'telefono'=>'76133846',
            'salario'=>'3500',
            'farmacia_id'=>'1'));

        personal::create(array(
            'nombre'=>'raul',
            'apellido'=>'aguirre',
            'password'=>'raulito123',
            'tipo'=>'ventas',
            'fecha_inicio'=>'1999-03-03',
            'ci'=>'76133846',
            'correo'=>'raulito123@gmail.com',
            'direccion'=>'bolivar y potosi',
            'telefono'=>'76133846',
            'salario'=>'3500',
            'farmacia_id'=>'1'));

        adquiere::factory(40)->create();

        cliente::factory(20)->create();

        factura::factory(20)->create();

        producto::factory(50)->create();

        detalle::factory(10)->create();

        lote::factory(20)->create();

    }
}
