<?php

use Illuminate\Database\Seeder;

class InnCodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inn_codes')->insert(['inn_code' => 'シティホテル']);
        DB::table('inn_codes')->insert(['inn_code' => 'リゾートホテル']);
        DB::table('inn_codes')->insert(['inn_code' => 'ビジネスホテル']);
        DB::table('inn_codes')->insert(['inn_code' => '旅館']);
        DB::table('inn_codes')->insert(['inn_code' => '民宿']);
        DB::table('inn_codes')->insert(['inn_code' => 'ペンション']);
    }
}
