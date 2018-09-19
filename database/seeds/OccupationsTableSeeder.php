<?php

use App\Occupation;
use Illuminate\Database\Seeder;

class OccupationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Occupation::create([
            'name' => 'super administrador',
            'description' => 'xxxxxxxxx',
            'abbreviation' => 'SuperAdmin',
        ]);
        Occupation::create([
            'name' => 'médico veterinario',
            'description' => 'xxxxxxxxx',
            'abbreviation' => 'MedVete',
        ]);
        Occupation::create([
            'name' => 'auxiliar de aseo',
            'description' => 'xxxxxxxxx',
            'abbreviation' => 'AuxAseo',
        ]);
        Occupation::create([
            'name' => 'auxiliar veterinario',
            'description' => 'xxxxxxxxx',
            'abbreviation' => 'AuxVete',
        ]);
        Occupation::create([
            'name' => 'peluquer@',
            'description' => 'xxxxxxxxx',
            'abbreviation' => 'Peluq',
        ]);
        Occupation::create([
            'name' => 'auxiliar administrativo',
            'description' => 'xxxxxxxxx',
            'abbreviation' => 'AuxAdmin',
        ]);
        Occupation::create([
            'name' => 'conductor',
            'description' => 'xxxxxxxxx',
            'abbreviation' => 'Conduc',
        ]);
        Occupation::create([
            'name' => 'administrador',
            'description' => 'xxxxxxxxx',
            'abbreviation' => 'Admin',
        ]);

        //factory(Occupation::class, 4)->create();
    }
}
