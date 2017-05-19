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
            'distance_travelled' => '2',
            'total_cost' => '2'
        ]);

        DB::table('routes')->insert([
            'user_id' => '1',
            'car_id' => '1',
            'distance_travelled' => '3',
            'total_cost' => '3'
        ]);

        DB::table('routes')->insert([
            'user_id' => '1',
            'car_id' => '1',
            'distance_travelled' => '4',
            'total_cost' => '4'
        ]);

        DB::table('routes')->insert([
            'user_id' => '1',
            'car_id' => '1',
            'distance_travelled' => '200',
            'total_cost' => '40'
        ]);


        DB::table('routes')->insert([
            'user_id' => '1',
            'car_id' => '1',
            'distance_travelled' => '1100',
            'total_cost' => '21'
        ]);

        DB::table('routes')->insert([
            'user_id' => '1',
            'car_id' => '1',
            'distance_travelled' => '1000',
            'total_cost' => '33'
        ]);

        DB::table('routes')->insert([
            'user_id' => '1',
            'car_id' => '1',
            'distance_travelled' => '900',
            'total_cost' => '46'
        ]);

        DB::table('routes')->insert([
            'user_id' => '1',
            'car_id' => '1',
            'distance_travelled' => '800',
            'total_cost' => '79'
        ]);

        DB::table('routes')->insert([
            'user_id' => '1',
            'car_id' => '1',
            'distance_travelled' => '700',
            'total_cost' => '89'
        ]);

        DB::table('routes')->insert([
            'user_id' => '1',
            'car_id' => '1',
            'distance_travelled' => '600',
            'total_cost' => '32'
        ]);

        DB::table('routes')->insert([
            'user_id' => '1',
            'car_id' => '1',
            'distance_travelled' => '500',
            'total_cost' => '40'
        ]);

        DB::table('routes')->insert([
            'user_id' => '1',
            'car_id' => '1',
            'distance_travelled' => '400',
            'total_cost' => '60'
        ]);

        DB::table('routes')->insert([
            'user_id' => '1',
            'car_id' => '1',
            'distance_travelled' => '300',
            'total_cost' => '50'
        ]);

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
