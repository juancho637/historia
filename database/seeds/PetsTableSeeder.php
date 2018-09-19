<?php

use App\Client;
use App\Pet;
use Illuminate\Database\Seeder;

class PetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Pet::class, 800)->create()->each(function ($pet){
            $clients = Client::all()->random(mt_rand(1, 3))->pluck('id');

            $pet->clients()->attach($clients);
        });
    }
}
