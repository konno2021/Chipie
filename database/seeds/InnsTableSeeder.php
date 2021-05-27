<?php

use Illuminate\Database\Seeder;

class InnsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<=50; $i++)
        {
            $inn= new \App\Inn([
                'name' => 'test num'. $i,
                'inn_code_id' => rand(1,5),
                'address'=> '東京都テスト区テスト'.$i,
                'email'=> 'testnum'.$i.'@index.com',
                'tel'=>'000-000-0'.$i,
                'check_in' => "15:$i:$i",
                'check_out' => "15:$i:$i",
                'password' => rand(10000000, 5000000000),
                'is_ok'=>false,
            ]);
            $inn->save();
        }
    }
}
