<?php

use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<=3; $i++)
        {
            $inn= new \App\Plan([
                'inn_id' => '94',//ここは自分で設定してください,
                'plan_name' => 'test'. $i,
                'description'=> 'これはtestプラン'.$i.'の概要です',
                'price'=> rand(4000,10000),
                'room' => rand(1,10),
                'started_at' => "2021-06-0$i 00:00:00",
                'ended_at' => "2021-06-0".($i+3)." 00:00:00",
            ]);
            $inn->save();
        }
    }
}
