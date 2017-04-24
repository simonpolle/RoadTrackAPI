<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Users */
        DB::table('users')->insert([
            'first_name' => 'Simon',
            'last_name' => 'Pollé',
            'email' => 'simon.polle@student.ehb.be',
            'password' => bcrypt('secret'),
            'role_id' => '1',
            'company_id' => '1',
            'api_token' => str_random(60)
        ]);

        DB::table('users')->insert([
            'first_name' => 'Wannes',
            'last_name' => 'Gennar',
            'email' => 'wannes.gennar@student.ehb.be',
            'password' => bcrypt('secret'),
            'role_id' => '1 ',
            'company_id' => '1',
            'api_token' => str_random(60)
        ]);

        /* Companies */
        DB::table('users')->insert([
            'first_name' => 'Dealloc',
            'last_name' => 'Devcave',
            'email' => 'dealloc@devcave.be',
            'password' => bcrypt('secret'),
            'role_id' => '2 ',
            'company_id' => '1',
            'api_token' => str_random(60)
        ]);

        /* Admin */
        DB::table('users')->insert([
            'first_name' => 'Admin',
            'last_name' => '',
            'email' => \'admin@admin.be',
            'password' => bcrypt('secret'),
            'role_id' => '3 ',
            'company_id' => '2',
            'api_token' => str_random(60)
        ]);
    }
}
