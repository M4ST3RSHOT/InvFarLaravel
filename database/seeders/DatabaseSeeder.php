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
use App\Models\User;

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
            'cinit'=>'123456789',
            'telefono'=>'789789789',
            'direccion'=>'BolivarPotosi',
        ));

        proveedor::create(array(
            'nombre'=>'SAVE',
            'cinit'=>'789456123',
            'telefono'=>'789789789',
            'direccion'=>'PotosiBolivar',
        ));

////////////////////////////////////////////////////////////////////////////////////////

        categoria::create(array(
            'nombre'=>'Antibioticos',
            'imagen'=>'Antibioticos.jpg'
        ));
        categoria::create(array(
            'nombre'=>'Analgesicos',
            'imagen'=>'Analgesicos.jpg'
        ));
        categoria::create(array(
            'nombre'=>'Antiinflamatorios',
            'imagen'=>'Antiinflamatorios.jpg'
        ));
        categoria::create(array(
            'nombre'=>'Antidepresivos',
            'imagen'=>'Antidepresivos.jpg'
        ));
        categoria::create(array(
            'nombre'=>'Antihistaminicos',
            'imagen'=>'Antihistaminicos.jpg'
        ));
        categoria::create(array(
            'nombre'=>'Antigripales',
            'imagen'=>'Antigripales.jpg'
        ));
        categoria::create(array(
            'nombre'=>'Antiacidos',
            'imagen'=>'Antiacidos.jpg'
        ));categoria::create(array(
            'nombre'=>'Antialergicos',
            'imagen'=>'Antialergicos.jpg'
        ));categoria::create(array(
            'nombre'=>'Jarabes para la tos',
            'imagen'=>'Jarabesparalatos.jpg'
        ));categoria::create(array(
            'nombre'=>'Productos de cuidado personal',
            'imagen'=>'cuidadopersonal.jpg'
        ));categoria::create(array(
            'nombre'=>'Multivitaminicos',
            'imagen'=>'Multivitaminicos.jpg'
        ));categoria::create(array(
            'nombre'=>'Suplementos',
            'imagen'=>'suplementos.jpg'
        ));categoria::create(array(
            'nombre'=>'Probioticos',
            'imagen'=>'probioticos.jpg'
        ));categoria::create(array(
            'nombre'=>'Productos para el cuidado del bebé',
            'imagen'=>'cuidadoparaelbebe.jpg'
        ));categoria::create(array(
            'nombre'=>'Cuidado Sexual',
            'imagen'=>'cuidadosexual.jpg'
        ));categoria::create(array(
            'nombre'=>'Cuidado Dental',
            'imagen'=>'cuidadodental.jpg'
        ));categoria::create(array(
            'nombre'=>'Dispositivos medicos y accesorios',
            'imagen'=>'dispositivosmedicosyaccesorios.jpg'
        ));categoria::create(array(
            'nombre'=>'Primero auxilios',
            'imagen'=>'primerosauxilios.jpg'
        ));categoria::create(array(
            'nombre'=>'Salud y bienestar',
            'imagen'=>'saludybienestar.jpg'
        ));categoria::create(array(
            'nombre'=>'Dieteticos y control de peso',
            'imagen'=>'dieteticos.jpg'
        ));
//////////////////////////////////////////////////////////////////////////////////////

        user::create(array(
            'nombre'=>'yamil',
            'apellido'=>'aguirre',
            'password'=>'yamilito123',
            'tipo'=>'Administrador',
            'fecha_inicio'=>'1999-03-03',
            'ci'=>'76133846',
            'correo'=>'yamilito123@gmail.com',
            'direccion'=>'bolivar y potosi',
            'telefono'=>'76133846',
            'salario'=>'3500',
            'farmacia_id'=>'1',
            'imagen'=>'YamilAguirre.jpg'));

        user::create(array(
            'nombre'=>'raul',
            'apellido'=>'aguirre',
            'password'=>'raulito123',
            'tipo'=>'Ventas',
            'fecha_inicio'=>'1999-03-03',
            'ci'=>'76133846',
            'correo'=>'raulito123@gmail.com',
            'direccion'=>'bolivar y potosi',
            'telefono'=>'76133846',
            'salario'=>'3500',
            'farmacia_id'=>'1',
            'imagen'=>'RaulAguirre.jpg'));

///////////////////////////////////////////////////////////////////////////////////////

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
            

            cliente::create(array(
                'nombre'=>'andres',
                'apellido'=>'Rojas',
                'fecha_nacimiento'=>'1999-03-03',
                'ci'=>'76133846',
                'correo'=>'juan@gmail.com',
                'telefono'=>'7777777',
                'imagen'=>'juanperez.jpg',));
                
    
            cliente::create(array(
                'nombre'=>'joel',
                'apellido'=>'gutierrez',
                'fecha_nacimiento'=>'1999-03-03',
                'ci'=>'76133846',
                'correo'=>'juan@gmail.com',
                'telefono'=>'7777777',
                'imagen'=>'juanperez.jpg',));
                
            cliente::create(array(
                'nombre'=>'alberto',
                'apellido'=>'sanchez',
                'fecha_nacimiento'=>'1999-03-03',
                'ci'=>'76133846',
                'correo'=>'juan@gmail.com',
                'telefono'=>'7777777',
                'imagen'=>'juanperez.jpg',));

////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        // producto::create(array(
        //     'nombre'=>'aspirina',
        //     'descripcion'=>'table de aspirina',
        //     'unidad'=>'gr',
        //     'peso'=>'500',
        //     'categoria_id'=>'1',
        //     'precio_compra'=>'3.5',
        //     'precio_venta'=>'5',
        //     'imagen'=>'aspirina.jpg',
        //     'stock'=>'15',));
        
        // producto::create(array(
        //     'nombre'=>'jarabito',
        //     'descripcion'=>'rajabe contra la tos',
        //     'unidad'=>'ml',
        //     'peso'=>'500',
        //     'categoria_id'=>'6',
        //     'precio_compra'=>'50',
        //     'precio_venta'=>'60',
        //     'imagen'=>'jarabito.jpg',
        //     'stock'=>'15',));

        // producto::create(array(
        //     'nombre'=>'ponds',
        //     'descripcion'=>'creama aclarante de piel',
        //     'unidad'=>'ml',
        //     'peso'=>'250',
        //     'categoria_id'=>'4',
        //     'precio_compra'=>'150',
        //     'precio_venta'=>'180',
        //     'imagen'=>'ponds.jpg',
        //     'stock'=>'10',));

        // producto::create(array(
        //     'nombre'=>'inyectable contra la tos',
        //     'descripcion'=>'inyectable contra la tos xd',
        //     'unidad'=>'ml',
        //     'peso'=>'50',
        //     'categoria_id'=>'2',
        //     'precio_compra'=>'45',
        //     'precio_venta'=>'60',
        //     'imagen'=>'inyectablexd.jpg',
        //     'stock'=>'10',));

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            
        // factura::create(array(
        //     'fecha'=>'2024-03-03',
        //     'subtotal'=>'200',
        //     'descuento'=>'10',
        //     'total'=>'180',
        //     'user_id'=>'1',
        //     'cliente_id'=>'1',));

        // factura::create(array(
        //     'fecha'=>'2024-03-03',
        //     'subtotal'=>'200',
        //     'descuento'=>'10',
        //     'total'=>'180',
        //     'user_id'=>'1',
        //     'cliente_id'=>'1',));
        
        // factura::create(array(
        //     'fecha'=>'2024-03-05',
        //     'subtotal'=>'400',
        //     'descuento'=>'10',
        //     'total'=>'360',
        //     'user_id'=>'2',
        //     'cliente_id'=>'2',));
        
        // factura::create(array(
        //     'fecha'=>'2024-03-05',
        //     'subtotal'=>'400',
        //     'descuento'=>'10',
        //     'total'=>'360',
        //     'user_id'=>'2',
        //     'cliente_id'=>'2',));

        // factura::create(array(
        //     'fecha'=>'2024-03-05',
        //     'subtotal'=>'400',
        //     'descuento'=>'10',
        //     'total'=>'360',
        //     'user_id'=>'2',
        //     'cliente_id'=>'2',));


        // detalle::create(array(
        //     'producto_id'=>'1',
        //     'cantidad'=>'1',
        //     'factura_id'=>'1',));

        // detalle::create(array(
        //     'producto_id'=>'1',
        //     'cantidad'=>'1',
        //     'factura_id'=>'1',));
        
        // detalle::create(array(
        //     'producto_id'=>'3',
        //     'cantidad'=>'1',
        //     'factura_id'=>'2',));

        // detalle::create(array(
        //     'producto_id'=>'1',
        //     'cantidad'=>'1',
        //     'factura_id'=>'2',));

        // detalle::create(array(
        //     'producto_id'=>'2',
        //     'cantidad'=>'1',
        //     'factura_id'=>'3',));

        // detalle::create(array(
        //     'producto_id'=>'2',
        //     'cantidad'=>'1',
        //     'factura_id'=>'3',));
        
        // detalle::create(array(
        //     'producto_id'=>'4',
        //     'cantidad'=>'1',
        //     'factura_id'=>'4',));

        // detalle::create(array(
        //     'producto_id'=>'3',
        //     'cantidad'=>'1',
        //     'factura_id'=>'4',));
        
        // detalle::create(array(
        //     'producto_id'=>'3',
        //     'cantidad'=>'1',
        //     'factura_id'=>'5',));

        // detalle::create(array(
        //     'producto_id'=>'2',
        //     'cantidad'=>'1',
        //     'factura_id'=>'5',));
            

        

        // adquiere::create(array(
        //     'proveedor_id'=>'1',
        //     'fecha'=>'2024-02-05',
        //     'montototal'=>'300',
        //     'user_id'=>'1',));

            
        // adquiere::create(array(
        //     'proveedor_id'=>'2',
        //     'fecha'=>'2024-02-06',
        //     'montototal'=>'1500',
        //     'user_id'=>'1',));

            
        // adquiere::create(array(
        //     'proveedor_id'=>'2',
        //     'fecha'=>'2024-02-07',
        //     'montototal'=>'2500',
        //     'user_id'=>'2',));

            
        // adquiere::create(array(
        //     'proveedor_id'=>'1',
        //     'fecha'=>'2024-02-07',
        //     'montototal'=>'2000',
        //     'user_id'=>'2',));

            
        // adquiere::create(array(
        //     'proveedor_id'=>'1',
        //     'fecha'=>'2024-02-08',
        //     'montototal'=>'2500',
        //     'user_id'=>'2',));


        // lote::create(array(
        //     'stock'=>'5',
        //     'fecha_expiracion'=>'2026-02-08',
        //     'adquiere_id'=>'1',
        //     'producto_id'=>'1',));

        // lote::create(array(
        //     'stock'=>'5',
        //     'fecha_expiracion'=>'2026-02-08',
        //     'adquiere_id'=>'1',
        //     'producto_id'=>'2',));

        // lote::create(array(
        //     'stock'=>'5',
        //     'fecha_expiracion'=>'2026-02-08',
        //     'adquiere_id'=>'2',
        //     'producto_id'=>'3',));

        // lote::create(array(
        //     'stock'=>'5',
        //     'fecha_expiracion'=>'2026-02-08',
        //     'adquiere_id'=>'2',
        //     'producto_id'=>'4',));

        // lote::create(array(
        //     'stock'=>'5',
        //     'fecha_expiracion'=>'2026-02-08',
        //     'adquiere_id'=>'3',
        //     'producto_id'=>'1',));

        // lote::create(array(
        //     'stock'=>'5',
        //     'fecha_expiracion'=>'2026-02-08',
        //     'adquiere_id'=>'3',
        //     'producto_id'=>'2',));

        // lote::create(array(
        //     'stock'=>'5',
        //     'fecha_expiracion'=>'2026-02-08',
        //     'adquiere_id'=>'4',
        //     'producto_id'=>'3',));

        // lote::create(array(
        //     'stock'=>'5',
        //     'fecha_expiracion'=>'2026-02-08',
        //     'adquiere_id'=>'4',
        //     'producto_id'=>'4',));

        // lote::create(array(
        //     'stock'=>'5',
        //     'fecha_expiracion'=>'2026-02-08',
        //     'adquiere_id'=>'5',
        //     'producto_id'=>'1',));

        // lote::create(array(
        //     'stock'=>'5',
        //     'fecha_expiracion'=>'2026-02-08',
        //     'adquiere_id'=>'5',
        //     'producto_id'=>'2',));


    }
}
