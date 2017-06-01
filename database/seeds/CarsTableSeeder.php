<?php

use Carbon\Carbon;
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
        for ($i = 1; $i < 37; $i++)
        {
            DB::table('cars')->insert([
                'licence_plate' => 1 . '-' . substr(str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyz", 3)), 0, 3) . '-' . substr(str_shuffle(str_repeat("0123456789", 3)), 0, 3),
                'user_id' => $i,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
