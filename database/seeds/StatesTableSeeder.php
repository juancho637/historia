<?php

use App\State;
use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // general states
        State::create([
            'name' => 'activo',
            'description' => 'registro activo en la base de datos',
            'abbreviation' => 'gen-act',
            'type' => 'general',
        ]);
        State::create([
            'name' => 'eliminado',
            'description' => 'registro eliminado parcialmente de la base de datos',
            'abbreviation' => 'gen-del',
            'type' => 'general',
        ]);

        // states of users
        State::create([
            'name' => 'inactivo',
            'description' => 'registro inactivo en la base de datos',
            'abbreviation' => 'usr-inact',
            'type' => 'users',
        ]);

        // states of appointments
        /*State::create([
            'name' => 'confirmada',
            'description' => 'estado de la cita confirmada',
            'abbreviation' => 'appoint-conf',
            'type' => 'appointments',
        ]);
        State::create([
            'name' => 'por confirmar',
            'description' => 'estado de la cita por confirmar',
            'abbreviation' => 'appoint-',
            'type' => 'appointments',
        ]);*/
        State::create([
            'name' => 'asistio',
            'description' => 'el cliente asistio a la cita',
            'abbreviation' => 'appoint-atten',
            'type' => 'appointments',
        ]);
        State::create([
            'name' => 'no asistio',
            'description' => 'el cliente no asistio a la cita',
            'abbreviation' => 'appoint-noatten',
            'type' => 'appointments',
        ]);
        /*State::create([
            'name' => 'atendida',
            'description' => 'estado de la cita atentida',
            'type' => 'appointments',
        ]);*/
        State::create([
            'name' => 'cancelada',
            'description' => 'estado de la cita cancelada',
            'abbreviation' => 'appoint-canceled',
            'type' => 'appointments',
        ]);
    }
}
