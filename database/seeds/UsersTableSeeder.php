²+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        /* Users */
        DB::table('users')->insert([
            'first_name' => 'Simon',
            'last_name' => 'Pollé',
            'email' => 'simon.polle@student.ehb.be',
            'password' => bcrypt('secret'),
            'image' => $faker->imageUrl(50, 50, 'cats', true, false),
            'role_id' => '1',
            'company_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'first_name' => 'Wannes',
            'last_name' => 'Gennar',
            'email' => 'wannes.gennar@student.ehb.be',
            'password' => bcrypt('secret'),
            'image' => $faker->imageUrl(50, 50, 'cats', true, false),
            'role_id' => '1',
            'company_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        for ($i=0; $i < 10; $i++) {
            DB::table('users')->insert([
                'first_name' => $faker->firstName($gender = null | 'male' | 'female'),
                'last_name' => $faker->lastName,
                'email' => $faker->safeEmail,
                'password' => bcrypt('secret'),
                'image' => $faker->imageUrl(50, 50, 'cats', true, false),
                'role_id' => '1',
                'company_id' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }

        for ($i=0; $i < 10; $i++) {
            DB::table('users')->insert([
                'first_name' => $faker->firstName($gender = null | 'male' | 'female'),
                'last_name' => $faker->lastName,
                'email' => $faker->safeEmail,
                'password' => bcrypt('secret'),
                'image' => $faker->imageUrl(50, 50, 'cats', true, false),
                'role_id' => '1',
                'company_id' => '2',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }

        for ($i=0; $i < 10; $i++) {
            DB::table('users')->insert([
                'first_name' => $faker->firstName($gender = null | 'male' | 'female'),
                'last_name' => $faker->lastName,
                'email' => $faker->safeEmail,
                'password' => bcrypt('secret'),
                'image' => $faker->imageUrl(50, 50, 'cats', true, false),
                'role_id' => '1',
                'company_id' => '3',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }

        /* Companies */
        DB::table('users')->insert([
            'first_name' => $faker->firstName($gender = null | 'male' | 'female'),
            'last_name' => $faker->lastName,
            'email' => 'admin@ehb.be',
            'password' => bcrypt('secret'),
            'image' => $faker->imageUrl(50, 50, 'cats', true, false),
            'role_id' => '2 ',
            'company_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'first_name' => $faker->firstName($gender = null | 'male' | 'female'),
            'last_name' => $faker->lastName,
            'email' => 'admin@realdolmen.be',
            'password' => bcrypt('secret'),
            'image' => $faker->imageUrl(50, 50, 'cats', true, false),
            'role_id' => '2 ',
            'company_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'first_name' => $faker->firstName($gender = null | 'male' | 'female'),
            'last_name' => $faker->lastName,
            'email' => 'admin@vub.be',
            'password' => bcrypt('secret'),
            'image' => $faker->imageUrl(50, 50, 'cats', true, false),
            'role_id' => '2 ',
            'company_id' => '3',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        /* Admin */
        DB::table('users')->insert([
            'first_name' => 'Admin',
            'last_name' => '',
            'email' => 'admin@admin.be',
            'password' => bcrypt('secret'),
            'image' => $faker->imageUrl(50, 50, 'cats', true, false),
            'role_id' => '3 ',
            'company_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
