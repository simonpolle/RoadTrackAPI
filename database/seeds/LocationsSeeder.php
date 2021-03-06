<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locations')->insert([
            'lat' => '50.74143',
            'lng' => '4.23958',
            'route_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('locations')->insert([
            'lat' => '50.74101',
            'lng' => '4.23914',
            'route_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('locations')->insert([
            'lat' => '50.74000',
            'lng' => '4.23758',
            'route_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('locations')->insert([
            'lat' => '50.73741',
            'lng' => '4.23231',
            'route_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('locations')->insert([
            'lat' => '50.73521',
            'lng' => '4.23005',
            'route_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('locations')->insert([
            'lat' => '50.73165',
            'lng' => '4.23031',
            'route_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('locations')->insert([
            'lat' => '50.72905',
            'lng' => '4.22892',
            'route_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}

