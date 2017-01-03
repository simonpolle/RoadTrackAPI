<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'name' => 'Erasmus Hogeschool Brussel',
            'street' => 'Quai de l\'Industrie',
            'street_number' => '170',
            'postal_code' => '1070',
            'country' => 'Belgium',
            'vat_number' => 'BE12345678910',
            'user_id' => '1'
        ]);

        DB::table('companies')->insert([
            'name' => 'Admin',
            'street' => 'x',
            'street_number' => 'x',
            'postal_code' => '123',
            'country' => 'Belgium',
            'vat_number' => 'x',
            'user_id' => '2'
        ]);
    }
}
