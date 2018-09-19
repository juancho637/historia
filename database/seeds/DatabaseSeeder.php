<?php

use App\Breed;
use App\Client;
use App\Dosage;
use App\Occupation;
use App\Pet;
use App\Product;
use App\Category;
use App\Provider;
use App\Service;
use App\Species;
use App\State;
use App\Stock;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Dosage::truncate();
        State::truncate();
        Occupation::truncate();
        User::truncate();
        Client::truncate();
        Species::truncate();
        Breed::truncate();
        Pet::truncate();
        DB::table('client_pet')->truncate();
        Provider::truncate();
        Category::truncate();
        Product::truncate();
        DB::table('product_provider')->truncate();
        DB::table('category_product')->truncate();
        Stock::truncate();
        Service::truncate();
        DB::table('service_user')->truncate();

        // flushEventListeners evita el lanzamiento de eventos a la hora de ejecutar los Sedders
        State::flushEventListeners();
        Occupation::flushEventListeners();
        User::flushEventListeners();
        Client::flushEventListeners();
        Species::flushEventListeners();
        Breed::flushEventListeners();
        Pet::flushEventListeners();
        Provider::flushEventListeners();
        Category::flushEventListeners();
        Product::flushEventListeners();
        Stock::flushEventListeners();
        Service::flushEventListeners();
        //Dosage::flushEventListeners();

        $this->call(StatesTableSeeder::class);
        $this->call(OccupationsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ClientsTableSeeder::class);
        $this->call(SpeciesTableSeeder::class);
        $this->call(BreedsTableSeeder::class);
        $this->call(PetsTableSeeder::class);
        $this->call(ProvidersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(StocksTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
    }
}
