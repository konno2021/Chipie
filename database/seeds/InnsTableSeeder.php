<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class InnsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<=5; $i++)
        {
            $inn= new \App\Inn([
                'name' => 'test'. $i,
                'inn_code_id' => rand(1,5),
                'address'=> '東京都テスト区テスト'.$i,
                'email'=> 'test'.$i.'@index.com',
                'tel'=>'000-000-00'.$i,
                'check_in' => "15:$i:$i",
                'check_out' => "15:$i:$i",
                'password' => Hash::make('123456789'),
                'is_ok'=>false,
            ]);
            $inn->save();
        }
    }
}
