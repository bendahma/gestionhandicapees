<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        //     'name' => 'Bendahma amine',
        //     'username' => 'Bendahma',
        //     'email' => 'bendahma@contact.com',
        //     'password' => Hash::make('aaaaaaaa'),
        //     'UserRole'=> 'admin',
        // ]);
        // DB::table('users')->insert([
        //     'name' => 'EMIR MALIKA',
        //     'username' => 'MALIKA',
        //     'email' => 'malika@contact.com',
        //     'password' => Hash::make('123456'),
        //     'UserRole' => 'supervisor'
        // ]);
        // DB::table('users')->insert([
        //         'name' => 'AKRMA KELTOUM',
        //         'username' => 'KELTOUM',
        //         'email' => 'keltoum@contact.com',
        //         'password' => Hash::make('dass46'),
        //         'UserRole' => 'ASSISTANCE',
        //         'nameAr' => 'عكرمة كلثوم',
        //     ]);
        // DB::table('users')->insert([
        //         'name' => 'DASS Ain Temouchent',
        //         'username' => 'dass_46',
        //         'email' => 'dass@contact.com',
        //         'password' => Hash::make('dass_46'),
        //         'UserRole' => 'ASSISTANCE',
        //         'nameAr' => '',
        //     ]);
        DB::table('users')->insert([
                'name' => 'DASS Ain Temouchent',
                'username' => 'dass46',
                'email' => 'bureauCarteHand@dass.com',
                'password' => Hash::make('dass46'),
                'UserRole' => 'ASSISTANCE',
                'nameAr' => '',
            ]);
    }
}
