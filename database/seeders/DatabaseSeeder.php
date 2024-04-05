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

        proveedor::create(array(
            'nombre'=>'INTI',
            'telefono'=>'789789789',
            'direccion'=>'BolivarPotosi',
        ));

        proveedor::create(array(
            'nombre'=>'SAVE',
            'telefono'=>'789789789',
            'direccion'=>'PotosiBolivar',
        ));

        categoria::create(array(
            'nombre'=>'Pildoras',
            'imagen'=>'pildoras.jpg'
        ));
        categoria::create(array(
            'nombre'=>'Inyectables',
            'imagen'=>'inyectables.jpg'
        ));
        categoria::create(array(
            'nombre'=>'Sueros',
            'imagen'=>'sueros.jpg'
        ));
        categoria::create(array(
            'nombre'=>'Cremas',
            'imagen'=>'cremas.jpg'
        ));
        categoria::create(array(
            'nombre'=>'Golosinas',
            'imagen'=>'golosinas.jpg'
        ));
        categoria::create(array(
            'nombre'=>'Medicamentos',
            'imagen'=>'medicamentos.jpg'
        ));

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
            'farmacia_id'=>'1',
            'imagen'=>'YamilAguirre.jpg'));

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
            'farmacia_id'=>'1',
            'imagen'=>'RaulAguirre.jpg'));



            cliente::create(array(
                'nombre'=>'Cliente',
                'apellido'=>'Cualquiera',
                'fecha_nacimiento'=>'1999-09-09',
                'ci'=>'1000001',
                'correo'=>'ClienteCualquiera@gmail.com',
                'telefono'=>'10000001',
                'imagen'=>'cliente.jpg',));


        cliente::create(array(
            'nombre'=>'Juan',
            'apellido'=>'Perez',
            'fecha_nacimiento'=>'1999-03-03',
            'ci'=>'76133846',
            'correo'=>'juan@gmail.com',
            'telefono'=>'7777777',
            'imagen'=>'juanperez.jpg',));
            

        cliente::create(array(
            'nombre'=>'Pedro',
            'apellido'=>'Dominguez',
            'fecha_nacimiento'=>'1999-03-03',
            'ci'=>'76133846',
            'correo'=>'juan@gmail.com',
            'telefono'=>'7777777',
            'imagen'=>'juanperez.jpg',));
            

        cliente::create(array(
            'nombre'=>'Carlos',
            'apellido'=>'Lozano',
            'fecha_nacimiento'=>'1999-03-03',
            'ci'=>'76133846',
            'correo'=>'juan@gmail.com',
            'telefono'=>'7777777',
            'imagen'=>'juanperez.jpg',));
            

        producto::create(array(
            'nombre'=>'aspirina',
            'descripcion'=>'table de aspirina',
            'unidad'=>'gr',
            'peso'=>'500',
            'categoria_id'=>'1',
            'precio_compra'=>'3.5',
            'precio_venta'=>'5',
            'imagen'=>'aspirina.jpg',
            'stock'=>'15',));
        
        producto::create(array(
            'nombre'=>'jarabito',
            'descripcion'=>'rajabe contra la tos',
            'unidad'=>'ml',
            'peso'=>'500',
            'categoria_id'=>'6',
            'precio_compra'=>'50',
            'precio_venta'=>'60',
            'imagen'=>'jarabito.jpg',
            'stock'=>'15',));

        producto::create(array(
            'nombre'=>'ponds',
            'descripcion'=>'creama aclarante de piel',
            'unidad'=>'ml',
            'peso'=>'250',
            'categoria_id'=>'4',
            'precio_compra'=>'150',
            'precio_venta'=>'180',
            'imagen'=>'ponds.jpg',
            'stock'=>'10',));

        producto::create(array(
            'nombre'=>'inyectable contra la tos',
            'descripcion'=>'inyectable contra la tos xd',
            'unidad'=>'ml',
            'peso'=>'50',
            'categoria_id'=>'2',
            'precio_compra'=>'45',
            'precio_venta'=>'60',
            'imagen'=>'inyectablexd.jpg',
            'stock'=>'10',));


            
        factura::create(array(
            'fecha'=>'2024-03-03',
            'subtotal'=>'200',
            'descuento'=>'10',
            'total'=>'180',
            'personal_id'=>'1',
            'cliente_id'=>'1',));

        factura::create(array(
            'fecha'=>'2024-03-03',
            'subtotal'=>'200',
            'descuento'=>'10',
            'total'=>'180',
            'personal_id'=>'1',
            'cliente_id'=>'1',));
        
        factura::create(array(
            'fecha'=>'2024-03-05',
            'subtotal'=>'400',
            'descuento'=>'10',
            'total'=>'360',
            'personal_id'=>'2',
            'cliente_id'=>'2',));
        
        factura::create(array(
            'fecha'=>'2024-03-05',
            'subtotal'=>'400',
            'descuento'=>'10',
            'total'=>'360',
            'personal_id'=>'2',
            'cliente_id'=>'2',));

        factura::create(array(
            'fecha'=>'2024-03-05',
            'subtotal'=>'400',
            'descuento'=>'10',
            'total'=>'360',
            'personal_id'=>'2',
            'cliente_id'=>'2',));


        detalle::create(array(
            'producto_id'=>'1',
            'cantidad'=>'1',
            'factura_id'=>'1',));

        detalle::create(array(
            'producto_id'=>'1',
            'cantidad'=>'1',
            'factura_id'=>'1',));
        
        detalle::create(array(
            'producto_id'=>'3',
            'cantidad'=>'1',
            'factura_id'=>'2',));

        detalle::create(array(
            'producto_id'=>'1',
            'cantidad'=>'1',
            'factura_id'=>'2',));

        detalle::create(array(
            'producto_id'=>'2',
            'cantidad'=>'1',
            'factura_id'=>'3',));

        detalle::create(array(
            'producto_id'=>'2',
            'cantidad'=>'1',
            'factura_id'=>'3',));
        
        detalle::create(array(
            'producto_id'=>'4',
            'cantidad'=>'1',
            'factura_id'=>'4',));

        detalle::create(array(
            'producto_id'=>'3',
            'cantidad'=>'1',
            'factura_id'=>'4',));
        
        detalle::create(array(
            'producto_id'=>'3',
            'cantidad'=>'1',
            'factura_id'=>'5',));

        detalle::create(array(
            'producto_id'=>'2',
            'cantidad'=>'1',
            'factura_id'=>'5',));
            

        

        adquiere::create(array(
            'proveedor_id'=>'1',
            'fecha'=>'2024-02-05',
            'montototal'=>'300',
            'personal_id'=>'1',));

            
        adquiere::create(array(
            'proveedor_id'=>'2',
            'fecha'=>'2024-02-06',
            'montototal'=>'1500',
            'personal_id'=>'1',));

            
        adquiere::create(array(
            'proveedor_id'=>'2',
            'fecha'=>'2024-02-07',
            'montototal'=>'2500',
            'personal_id'=>'2',));

            
        adquiere::create(array(
            'proveedor_id'=>'1',
            'fecha'=>'2024-02-07',
            'montototal'=>'2000',
            'personal_id'=>'2',));

            
        adquiere::create(array(
            'proveedor_id'=>'1',
            'fecha'=>'2024-02-08',
            'montototal'=>'2500',
            'personal_id'=>'2',));


        lote::create(array(
            'stock'=>'5',
            'fecha_expiracion'=>'2026-02-08',
            'adquiere_id'=>'1',
            'producto_id'=>'1',));

        lote::create(array(
            'stock'=>'5',
            'fecha_expiracion'=>'2026-02-08',
            'adquiere_id'=>'1',
            'producto_id'=>'2',));

        lote::create(array(
            'stock'=>'5',
            'fecha_expiracion'=>'2026-02-08',
            'adquiere_id'=>'2',
            'producto_id'=>'3',));

        lote::create(array(
            'stock'=>'5',
            'fecha_expiracion'=>'2026-02-08',
            'adquiere_id'=>'2',
            'producto_id'=>'4',));

        lote::create(array(
            'stock'=>'5',
            'fecha_expiracion'=>'2026-02-08',
            'adquiere_id'=>'3',
            'producto_id'=>'1',));

        lote::create(array(
            'stock'=>'5',
            'fecha_expiracion'=>'2026-02-08',
            'adquiere_id'=>'3',
            'producto_id'=>'2',));

        lote::create(array(
            'stock'=>'5',
            'fecha_expiracion'=>'2026-02-08',
            'adquiere_id'=>'4',
            'producto_id'=>'3',));

        lote::create(array(
            'stock'=>'5',
            'fecha_expiracion'=>'2026-02-08',
            'adquiere_id'=>'4',
            'producto_id'=>'4',));

        lote::create(array(
            'stock'=>'5',
            'fecha_expiracion'=>'2026-02-08',
            'adquiere_id'=>'5',
            'producto_id'=>'1',));

        lote::create(array(
            'stock'=>'5',
            'fecha_expiracion'=>'2026-02-08',
            'adquiere_id'=>'5',
            'producto_id'=>'2',));

    }
}
