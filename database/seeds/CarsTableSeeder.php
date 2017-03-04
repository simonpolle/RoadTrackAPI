<?php

use Illuminate\Database\Seeder;

class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cars')->insert([
            'licence_plate' => 'wdp-195',
            'user_id' => '1'
        ]);

        DB::table('cars')->insert([
            'licence_plate' => 'xml-358',
            'user_id' => '4'
        ]);
    }
}
