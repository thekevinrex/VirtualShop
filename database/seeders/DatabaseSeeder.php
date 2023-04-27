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

        \App\Models\Province::create(['name' => 'Sancti Spiritus']);
        \App\Models\Province::create(['name' => 'La Habana']);
        \App\Models\Province::create(['name' => 'Matanzas']);

        \App\Models\Municipality::create([
            'name' => 'Sancti Spiritus',
            'price' => '10',
            'province_id' => 1
        ]);
        \App\Models\Municipality::create([
            'name' => 'Trinidad',
            'price' => '20',
            'province_id' => 1
        ]);
        \App\Models\Municipality::create([
            'name' => 'Lawton',
            'price' => '50',
            'province_id' => 2
        ]);
        \App\Models\Municipality::create([
            'name' => 'Vedado',
            'price' => '100',
            'province_id' => 2
        ]);
        \App\Models\Municipality::create([
            'name' => 'Bahia',
            'price' => '5',
            'province_id' => 2
        ]);
        \App\Models\Municipality::create([
            'name' => 'Lisa',
            'price' => '100',
            'province_id' => 2
        ]);
        \App\Models\Municipality::create([
            'name' => 'Matanzas',
            'price' => '100',
            'province_id' => 3
        ]);


        \App\Models\Category::create([
            'key' => 'Electronics',
            'des' => 'Prueba categoria',
            'porcent' => 8,
            'require' => 'marca|modelo',
        ]);
        \App\Models\Category::create([
            'key' => 'Products Agricolas',
            'des' => 'Prueba categoria',
            'porcent' => 2,
            'require' => 'restricted',
        ]);
        \App\Models\Category::create([
            'key' => 'Alcoholics drinks',
            'des' => 'Prueba categoria',
            'porcent' => 15,
            'require' => 'marca|restricted',
        ]);
        \App\Models\Category::create([
            'key' => 'Artesania',
            'des' => 'Prueba categoria',
            'porcent' => 3,
            'require' => '',
        ]);

        \App\Models\Category::create([
            'key' => 'Electronics accesories',
            'des' => 'Prueba categoria',
            'porcent' => 5,
            'require' => 'marca|modelo',
        ]);

        \App\Models\Category::create([
            'key' => 'Foods',
            'des' => 'Prueba categoria',
            'porcent' => 2,
            'require' => '',
        ]);
        \App\Models\Category::create([
            'key' => 'Electrodomestics',
            'des' => 'Prueba categoria',
            'porcent' => 8,
            'require' => 'marca|modelo',
        ]);

        \App\Models\Brand::create(['name' => 'Xiaomi']);
        \App\Models\Brand::create(['name' => 'Hp']);
        \App\Models\Brand::create(['name' => 'Konka']);
        \App\Models\Brand::create(['name' => 'RCA']);
        \App\Models\Brand::create(['name' => 'Samsung']);
        \App\Models\Brand::create(['name' => 'Hawei']);
        \App\Models\Brand::create(['name' => 'Apple']);

        \App\Models\BrandModel::create(['brand_id' => 1, 'name' => 'Redmi note 9']);
        \App\Models\BrandModel::create([ 'brand_id' => 1, 'name' => 'Mi band 6' ]);
        \App\Models\BrandModel::create([ 'brand_id' => 1, 'name' => 'Mi 9', 'detail' => 'Pro' ]);
        \App\Models\BrandModel::create([ 'brand_id' => 2, 'name' => 'Pavilion' ]);
        \App\Models\BrandModel::create([ 'brand_id' => 5, 'name' => 'Note 10' ]);
        \App\Models\BrandModel::create([ 'brand_id' => 5, 'name' => 'S 22' ]);
        \App\Models\BrandModel::create([ 'brand_id' => 5, 'name' => 'S 20', 'detail' => 'Ultra' ]);
        \App\Models\BrandModel::create([ 'brand_id' => 6, 'name' => 'Honor 20' ]);
        \App\Models\BrandModel::create([ 'brand_id' => 7, 'name' => 'Iphone 12' ]);
        \App\Models\BrandModel::create([ 'brand_id' => 7, 'name' => 'Iphone 14', 'detail' => 'Pro' ]);
        \App\Models\BrandModel::create([ 'brand_id' => 7, 'name' => 'Imac 2' ]);
        \App\Models\BrandModel::create([ 'brand_id' => 7, 'name' => 'Ipad 13' ]);
    }
}
