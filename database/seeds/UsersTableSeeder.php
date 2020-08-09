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
<<<<<<< HEAD
        // DB::table('users')->insert([
        //     'name' => 'Bendahma amine',
        //     'username' => 'Bendahma',
        //     'email' => 'bendahma@contact.com',
        //     'password' => Hash::make('aaaaaaaa')
        // ]);
       /* DB::table('users')->insert([
=======
        DB::table('users')->insert([
            'name' => 'Bendahma amine',
            'username' => 'Bendahma',
            'email' => 'bendahma@contact.com',
            'password' => Hash::make('aaaaaaaa'),
            'role'=> 'admin',
        ]);
        DB::table('users')->insert([
>>>>>>> ebcea4b0270816f32e0a24123fc7538b230a81b1
            'name' => 'EMIR MALIKA',
            'username' => 'MALIKA',
            'email' => 'malika@contact.com',
            'password' => Hash::make('123456'),
<<<<<<< HEAD
            'nameAr' => 'أمير مليكة',
        ]);*/

         DB::table('users')->insert([
            'name' => 'AKERMA KELTOUM',
            'username' => 'KELTOUM',
            'email' => 'keltoum@contact.com',
            'password' => Hash::make('dass46'),
            'nameAr' => 'عكرمة كلثوم',
=======
            'role' => 'supervisor'
>>>>>>> ebcea4b0270816f32e0a24123fc7538b230a81b1
        ]);
    }
}
