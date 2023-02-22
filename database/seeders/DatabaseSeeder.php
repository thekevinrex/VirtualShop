<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\Provincia::create(['name' => 'Sancti Spiritus']);
        \App\Models\Provincia::create(['name' => 'La Habana']);
        \App\Models\Provincia::create(['name' => 'Matanzas']);

        \App\Models\Municipio::create([
            'name' => 'Sancti Spiritus',
            'price' => '10',
            'provincia_id' => 1
        ]);
        \App\Models\Municipio::create([
            'name' => 'Trinidad',
            'price' => '20',
            'provincia_id' => 1
        ]);
        \App\Models\Municipio::create([
            'name' => 'Lawton',
            'price' => '50',
            'provincia_id' => 2
        ]);
        \App\Models\Municipio::create([
            'name' => 'Vedado',
            'price' => '100',
            'provincia_id' => 2
        ]);
        \App\Models\Municipio::create([
            'name' => 'Bahia',
            'price' => '5',
            'provincia_id' => 2
        ]);
        \App\Models\Municipio::create([
            'name' => 'Lisa',
            'price' => '100',
            'provincia_id' => 2
        ]);
        \App\Models\Municipio::create([
            'name' => 'Matanzas',
            'price' => '100',
            'provincia_id' => 3
        ]);


        \App\Models\Category::create([
            'name' => 'Electronicos',
            'name_key' => 'categories.electronicos',
            'des' => 'Prueba categoria',
            'porcent' => 8,
            'require' => 'marca|modelo',
        ]);
        \App\Models\Category::create([
            'name' => 'Productos Agricoloas',
            'name_key' => 'categories.agricolas',
            'des' => 'Prueba categoria',
            'porcent' => 2,
            'require' => 'restricted',
        ]);
        \App\Models\Category::create([
            'name' => 'Bebidas Alcoholicas',
            'name_key' => 'categories.alcoholicas',
            'des' => 'Prueba categoria',
            'porcent' => 15,
            'require' => 'marca|restricted',
        ]);
        \App\Models\Category::create([
            'name' => 'Artesania',
            'name_key' => 'categories.artesania',
            'des' => 'Prueba categoria',
            'porcent' => 3,
            'require' => '',
        ]);
        \App\Models\Category::create([
            'name' => 'Accesorios de Electronicos',
            'name_key' => 'categories.electronicos_accessorio',
            'des' => 'Prueba categoria',
            'porcent' => 5,
            'require' => 'marca|modelo',
        ]);
        \App\Models\Category::create([
            'name' => 'Comidas',
            'name_key' => 'categories.comidas',
            'des' => 'Prueba categoria',
            'porcent' => 2,
            'require' => '',
        ]);
        \App\Models\Category::create([
            'name' => 'Electrodomesticos',
            'name_key' => 'categories.electrodomesticos',
            'des' => 'Prueba categoria',
            'porcent' => 8,
            'require' => 'marca|modelo',
        ]);

        \App\Models\Marca::create(['name' => 'Xiaomi']);
        \App\Models\Marca::create(['name' => 'Hp']);
        \App\Models\Marca::create(['name' => 'Konka']);
        \App\Models\Marca::create(['name' => 'RCA']);
        \App\Models\Marca::create(['name' => 'Samsung']);
        \App\Models\Marca::create(['name' => 'Hawei']);
        \App\Models\Marca::create(['name' => 'Apple']);

        \App\Models\Modelo::create(['marca_id' => 1, 'name' => 'Redmi note 9']);
        \App\Models\Modelo::create([ 'marca_id' => 1, 'name' => 'Mi band 6' ]);
        \App\Models\Modelo::create([ 'marca_id' => 1, 'name' => 'Mi 9', 'detail' => 'Pro' ]);
        \App\Models\Modelo::create([ 'marca_id' => 2, 'name' => 'Pavilion' ]);
        \App\Models\Modelo::create([ 'marca_id' => 5, 'name' => 'Note 10' ]);
        \App\Models\Modelo::create([ 'marca_id' => 5, 'name' => 'S 22' ]);
        \App\Models\Modelo::create([ 'marca_id' => 5, 'name' => 'S 20', 'detail' => 'Ultra' ]);
        \App\Models\Modelo::create([ 'marca_id' => 6, 'name' => 'Honor 20' ]);
        \App\Models\Modelo::create([ 'marca_id' => 7, 'name' => 'Iphone 12' ]);
        \App\Models\Modelo::create([ 'marca_id' => 7, 'name' => 'Iphone 14', 'detail' => 'Pro' ]);
        \App\Models\Modelo::create([ 'marca_id' => 7, 'name' => 'Imac 2' ]);
        \App\Models\Modelo::create([ 'marca_id' => 7, 'name' => 'Ipad 13' ]);
    }
}
