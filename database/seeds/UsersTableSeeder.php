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
        //     'role'=> 'admin',
        // ]);
        // DB::table('users')->insert([
        //     'name' => 'EMIR MALIKA',
        //     'username' => 'MALIKA',
        //     'email' => 'malika@contact.com',
        //     'password' => Hash::make('123456'),
        //     'role' => 'supervisor'
        // ]);
        DB::table('users')->insert([
                'name' => 'AKRMA KELTOUM',
                'username' => 'KELTOUM',
                'email' => 'keltoum@contact.com',
                'password' => Hash::make('dass46'),
                'role' => 'ASSISTANCE',
                'nameAr' => 'عكرمة كلثوم',
            ]);
    }
}
