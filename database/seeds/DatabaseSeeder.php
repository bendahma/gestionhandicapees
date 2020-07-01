<?php

use Illuminate\Database\Seeder;
use App\PaieInformation;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(MoisSeeder::class);
        $this->call(PaieSeeder::class);
        $this->call(BudgetSeeder::class);
    }
}
