<?php

use Illuminate\Database\Seeder;

class FillUsersFinfo extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->update([
            'nameAr' => 'قدور بن دهمة محمد الأمين'
        ]);
    }
}
