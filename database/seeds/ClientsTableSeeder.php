<?php

use App\Client;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::create([
            'type_identification' => 'CC',
            'identification' => 1107088223,
            'full_name' => 'Juan David Garcia Reyes',
            'email' => 'juan@mail.com',
            'cell_phone' => '(315) 601-1981',
            'phone' => '(032) 440-1233',
            'address' => 'Cra 1a 12',
            'birth_date' => '1995-05-28',
            'gender' => 'M',
            'smoker' => false,
            'junkie' => false,
        ]);

        factory(Client::class, 6000)->create();
    }
}
