<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(Category::class, 20)->create();

        Category::create([
            'name' => 'Peluquería',
            'description' => 'xxx',
            'abbreviation' => 'aesthetic'
        ]);
        Category::create([
            'name' => 'Farmacia',
            'description' => 'xxx',
            'abbreviation' => 'pharmacy'
        ]);
        Category::create([
            'name' => 'Servicios Médicos',
            'description' => 'xxx',
            'abbreviation' => 'services'
        ]);
        Category::create([
            'name' => 'Domicilios',
            'description' => 'xxx',
            'abbreviation' => 'home_services'
        ]);
        Category::create([
            'name' => 'Cirugías',
            'description' => 'xxx',
            'abbreviation' => 'surgery'
        ]);
        Category::create([
            'name' => 'Consultas',
            'description' => 'xxx',
            'abbreviation' => 'consultation'
        ]);
    }
}
