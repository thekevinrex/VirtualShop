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

        \App\Models\Provincia::create(
            ['name' => 'Sancti Spiritus'],
        );
        \App\Models\Provincia::create(
            ['name' => 'La Habana'],
        );
        \App\Models\Provincia::create(
            ['name' => 'Matanzas'],
        );

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

        
    }
}
