<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('nl_NL');

        DB::table('companies')->insert([
            'name' => 'Erasmus Hogeschool Brussel',
            'street' => 'Quai de l\'Industrie',
            'street_number' => '170',
            'postal_code' => '1070',
            'country' => 'Belgium',
            'vat_number' => $faker->iban('BE'),
            'user_id' => '1'
        ]);

        DB::table('companies')->insert([
            'name' => 'Realdolmen',
            'street' => 'Industriezone Zenneveld, A. Vaucampslaan',
            'street_number' => '42',
            'postal_code' => '1654',
            'country' => 'Belgium',
            'vat_number' => $faker->iban('BE'),
            'user_id' => '1'
        ]);

        DB::table('companies')->insert([
            'name' => 'VUB',
            'street' => 'Pleinlaan',
            'street_number' => '2',
            'postal_code' => '1050',
            'country' => 'Belgium',
            'vat_number' => $faker->iban('BE'),
            'user_id' => '1'
        ]);
    }
}
