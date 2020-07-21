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
        //     'password' => Hash::make('aaaaaaaa')
        // ]);
        DB::table('users')->insert([
            'name' => 'EMIR MALIKA',
            'username' => 'MALIKA',
            'email' => 'malika@contact.com',
            'password' => Hash::make('123456')
        ]);
    }
}
