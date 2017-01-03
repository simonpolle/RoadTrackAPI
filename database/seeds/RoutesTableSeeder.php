<?php

use Illuminate\Database\Seeder;

class RoutesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('routes')->insert([
            'user_id' => '1',
            'car_id' => '1',
            'distance_travelled' => '200',
            'total_cost' => '40'
        ]);

        DB::table('routes')->insert([
            'user_id' => '1',
            'car_id' => '1',
            'distance_travelled' => '100',
            'total_cost' => '20'
        ]);

        DB::table('routes')->insert([
            'user_id' => '1',
            'car_id' => '1',
            'distance_travelled' => '50',
            'total_cost' => '10'
        ]);

        DB::table('routes')->insert([
            'user_id' => '1',
            'car_id' => '1',
            'distance_travelled' => '25',
            'total_cost' => '5'
        ]);

        DB::table('routes')->insert([
            'user_id' => '1',
            'car_id' => '1',
            'distance_travelled' => '5',
            'total_cost' => '2'
        ]);
    }
}
