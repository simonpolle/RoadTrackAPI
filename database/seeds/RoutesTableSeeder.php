<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoutesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++)
        {
            DB::table('routes')->insert([
                'user_id' => '1',
                'car_id' => '1',
                'distance_travelled' => $i + 10 * 1.25,
                'total_cost' => $i + 10 * 1.25 * 0.75,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            DB::table('routes')->insert([
                'user_id' => '29',
                'car_id' => '1',
                'distance_travelled' => $i + 10 * 1.25,
                'total_cost' => $i + 10 * 1.25 * 0.75,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
