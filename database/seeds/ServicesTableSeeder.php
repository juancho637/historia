<?php

use App\Service;
use App\User;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create([
            'name' => 'estética',
            'description' => 'servicios varios que conllevan la parte estética de la mascota',
            'abbreviation' => 'aesthetic',
        ])->users()->attach(User::ofOccupation([3, 4, 5, 1])->get()->pluck('id'));

        Service::create([
            'name' => 'servicios médicos',
            'description' => 'servicios que presta la clínica aparte de las consultas veterianarias',
            'abbreviation' => 'services',
        ])->users()->attach(User::ofOccupation([2, 4, 5, 1])->get()->pluck('id'));

        Service::create([
            'name' => 'consulta veterinaria',
            'description' => 'servicio de consultas veterinarias',
            'abbreviation' => 'consultation',
        ])->users()->attach(User::ofOccupation([2, 1])->get()->pluck('id'));

        Service::create([
            'name' => 'cirugía',
            'description' => 'servicio de cirugías veterinarias',
            'abbreviation' => 'surgery',
        ])->users()->attach(User::ofOccupation([2, 1])->get()->pluck('id'));
    }
}
