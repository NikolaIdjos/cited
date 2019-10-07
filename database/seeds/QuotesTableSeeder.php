<?php

use App\Quote;
use Illuminate\Database\Seeder;

class QuotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i = 0; $i <= 50; $i++) {
            Quote::create([
                'description' => $faker->text(),
            ]);
        }
    }
}
