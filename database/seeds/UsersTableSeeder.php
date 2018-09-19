<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'identification' => 1107088223,
            'name' => 'Juan David',
            'last_name' => 'Garcia Reyes',
            'full_name' => 'Juan David Garcia Reyes',
            'professional_identification' => 1234,
            'address' => 'Cra 1a 12',
            'cell_phone' => '(315) 601-1981',
            'phone' => '(032) 440-1233',
            'email' => 'juan@mail.com',
            'occupation_id' => 1,
            'password_change' => true,
            'password' => bcrypt('secret'),
        ]);

        factory(User::class, 30)->create();
    }
}
