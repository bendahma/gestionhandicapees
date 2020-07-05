<?php

use Illuminate\Database\Seeder;

class CommuneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('communes')->insert([
            'codeCommune' => '4601',
            'nomCommuneFr' => 'AIN TEMOUCHENT',
            'nomCommuneAr' => 'عين تموشنت'
        ]);
        DB::table('communes')->insert([
            'codeCommune' => '4602',
            'nomCommuneFr' => 'SIDI BEN ADDA',
            'nomCommuneAr' => 'سيدي بن عدة'
        ]);
        DB::table('communes')->insert([
            'codeCommune' => '4603',
            'nomCommuneFr' => 'El MALEH',
            'nomCommuneAr' => 'المالح'
        ]);
        DB::table('communes')->insert([
            'codeCommune' => '4604',
            'nomCommuneFr' => 'CHAABAT',
            'nomCommuneAr' => 'شعبة اللحم'
        ]);
        DB::table('communes')->insert([
            'codeCommune' => '4605',
            'nomCommuneFr' => 'TERGA',
            'nomCommuneAr' => 'تارقة'
        ]);
        DB::table('communes')->insert([
            'codeCommune' => '4606',
            'nomCommuneFr' => 'OULED KIHEL',
            'nomCommuneAr' => 'واد الكيحل'
        ]);
        DB::table('communes')->insert([
            'codeCommune' => '4607',
            'nomCommuneFr' => 'EL AMRIA',
            'nomCommuneAr' => 'العامرية'
        ]);
        DB::table('communes')->insert([
            'codeCommune' => '4608',
            'nomCommuneFr' => 'HASSI EL GHELA',
            'nomCommuneAr' => 'حاسي الغلة'
        ]);
        DB::table('communes')->insert([
            'codeCommune' => '4609',
            'nomCommuneFr' => 'OULED BOUDJEMA',
            'nomCommuneAr' => 'أولاد بوجمعة'
        ]);
        DB::table('communes')->insert([
            'codeCommune' => '4610',
            'nomCommuneFr' => 'BOUZEDJAR',
            'nomCommuneAr' => 'بوزجار'
        ]);
        DB::table('communes')->insert([
            'codeCommune' => '4611',
            'nomCommuneFr' => 'M\'SAID',
            'nomCommuneAr' => 'المساعيد'
        ]);
        DB::table('communes')->insert([
            'codeCommune' => '4612',
            'nomCommuneFr' => 'HAMAM BOUHDJAR',
            'nomCommuneAr' => 'حمام بوحجر'
        ]);
        DB::table('communes')->insert([
            'codeCommune' => '4613',
            'nomCommuneFr' => 'CHENTOUF',
            'nomCommuneAr' => 'شنتوف'
        ]);
        DB::table('communes')->insert([
            'codeCommune' => '4614',
            'nomCommuneFr' => 'HASSASSNA',
            'nomCommuneAr' => 'حساسنة'
        ]);
        DB::table('communes')->insert([
            'codeCommune' => '4615',
            'nomCommuneFr' => 'OUED BEREKECHE',
            'nomCommuneAr' => 'واد برقش'
        ]);
        DB::table('communes')->insert([
            'codeCommune' => '4616',
            'nomCommuneFr' => 'AIN EL ARBAA',
            'nomCommuneAr' => 'عين الأربعاء'
        ]);
        DB::table('communes')->insert([
            'codeCommune' => '4617',
            'nomCommuneFr' => 'SIDI BOUMEDIENE',
            'nomCommuneAr' => 'سيدي بومدين'
        ]);
        DB::table('communes')->insert([
            'codeCommune' => '4618',
            'nomCommuneFr' => 'OUED SEBBAH',
            'nomCommuneAr' => 'واد الصباح'
        ]);
        DB::table('communes')->insert([
            'codeCommune' => '4619',
            'nomCommuneFr' => 'TAMEZOURA',
            'nomCommuneAr' => 'تامزوغة'
        ]);
        DB::table('communes')->insert([
            'codeCommune' => '4620',
            'nomCommuneFr' => 'AIN KIHAL',
            'nomCommuneAr' => 'عين الكيحل'
        ]);
        DB::table('communes')->insert([
            'codeCommune' => '4621',
            'nomCommuneFr' => 'AIN TOLBA',
            'nomCommuneAr' => 'عين الطلبة'
        ]);
        DB::table('communes')->insert([
            'codeCommune' => '4622',
            'nomCommuneFr' => 'AGHLLAL',
            'nomCommuneAr' => 'أغلال'
        ]);
        DB::table('communes')->insert([
            'codeCommune' => '4623',
            'nomCommuneFr' => 'AOUGBELLIL',
            'nomCommuneAr' => 'عقب الليل'
        ]);
        DB::table('communes')->insert([
            'codeCommune' => '4624',
            'nomCommuneFr' => 'BENI SAF',
            'nomCommuneAr' => 'بني صاف'
        ]);
        DB::table('communes')->insert([
            'codeCommune' => '4625',
            'nomCommuneFr' => 'SIDI SAFI',
            'nomCommuneAr' => 'سيدي صافي'
        ]);
        DB::table('communes')->insert([
            'codeCommune' => '4626',
            'nomCommuneFr' => 'EMIR ABDELKADER',
            'nomCommuneAr' => 'الأمير عبد القادر'
        ]);
        DB::table('communes')->insert([
            'codeCommune' => '4627',
            'nomCommuneFr' => 'OULHACA',
            'nomCommuneAr' => 'ولهاصة'
        ]);
        DB::table('communes')->insert([
            'codeCommune' => '4628',
            'nomCommuneFr' => 'SIDI OURIACHE',
            'nomCommuneAr' => 'سيدي ورياش'
        ]);
    }
}
