<?php

use App\Category;
use App\Product;
use App\Provider;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p1 = Product::create([
            'name' => 'CONSULTA DIURNA',
            'value' => 50000,
            'tax_percentage' => 19,
            'description' => 'xxx',
            'type' => 'servicio',
            'category_id' => Category::where('abbreviation', 'consultation')->first()->id
        ]);
        $p1->providers()->attach(Provider::all()->random(mt_rand(1, 3))->pluck('id'));

        $p2 = Product::create([
            'name' => 'CONSULTA DOMINICAL Y FESTIVO DIA',
            'value' => 66000,
            'tax_percentage' => 19,
            'description' => 'xxx',
            'type' => 'servicio',
            'category_id' => Category::where('abbreviation', 'consultation')->first()->id
        ]);
        $p2->providers()->attach(Provider::all()->random(mt_rand(1, 3))->pluck('id'));

        $p3 = Product::create([
            'name' => 'CONSULTA NOCTURNA A PARTIR DE 09:00 PM',
            'value' => 66000,
            'tax_percentage' => 19,
            'description' => 'xxx',
            'type' => 'servicio',
            'category_id' => Category::where('abbreviation', 'consultation')->first()->id
        ]);
        $p3->providers()->attach(Provider::all()->random(mt_rand(1, 3))->pluck('id'));

        $p4 = Product::create([
            'name' => 'CONSULTA ESPECIALISTA EXTERNO',
            'value' => 114000,
            'tax_percentage' => 19,
            'description' => 'xxx',
            'type' => 'servicio',
            'category_id' => Category::where('abbreviation', 'consultation')->first()->id
        ]);
        $p4->providers()->attach(Provider::all()->random(mt_rand(1, 3))->pluck('id'));

        $p5 = Product::create([
            'name' => 'CONSULTA DOMICILIARIA',
            'value' => 130000,
            'tax_percentage' => 19,
            'description' => 'xxx',
            'type' => 'servicio',
            'category_id' => Category::where('abbreviation', 'consultation')->first()->id
        ]);
        $p5->providers()->attach(Provider::all()->random(mt_rand(1, 3))->pluck('id'));

        $p6 = Product::create([
            'name' => 'CONSULTA DR. AICARDO ARISTIZABAL',
            'value' => 70000,
            'tax_percentage' => 19,
            'description' => 'xxx',
            'type' => 'servicio',
            'category_id' => Category::where('abbreviation', 'consultation')->first()->id
        ]);
        $p6->providers()->attach(Provider::all()->random(mt_rand(1, 3))->pluck('id'));

        $p7 = Product::create([
            'name' => 'CONSULTA DRA. MARTA NARANO',
            'value' => 70000,
            'tax_percentage' => 19,
            'description' => 'xxx',
            'type' => 'servicio',
            'category_id' => Category::where('abbreviation', 'consultation')->first()->id
        ]);
        $p7->providers()->attach(Provider::all()->random(mt_rand(1, 3))->pluck('id'));

        $p8 = Product::create([
            'name' => 'CONSULTA DE EMERGENCIA',
            'value' => 80000,
            'tax_percentage' => 19,
            'description' => 'xxx',
            'type' => 'servicio',
            'category_id' => Category::where('abbreviation', 'consultation')->first()->id
        ]);
        $p8->providers()->attach(Provider::all()->random(mt_rand(1, 3))->pluck('id'));

        $p9 = Product::create([
            'name' => 'CONSULTA DE CONTROL',
            'value' => 30000,
            'tax_percentage' => 19,
            'description' => 'xxx',
            'type' => 'servicio',
            'category_id' => Category::where('abbreviation', 'consultation')->first()->id
        ]);
        $p9->providers()->attach(Provider::all()->random(mt_rand(1, 3))->pluck('id'));

        $p10 = Product::create([
            'name' => 'CONSULTA SIN COSTO',
            'value' => 0,
            'tax_percentage' => 0,
            'description' => 'xxx',
            'type' => 'servicio',
            'category_id' => Category::where('abbreviation', 'consultation')->first()->id
        ]);
        $p10->providers()->attach(Provider::all()->random(mt_rand(1, 3))->pluck('id'));

        factory(Product::class, 1000)->create()->each(function ($product){
            $providers = Provider::all()->random(mt_rand(1, 3))->pluck('id');

            $product->providers()->attach($providers);
        });
    }
}
