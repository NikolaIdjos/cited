<?php

use Illuminate\Database\Seeder;
use App\Subscriber;

class SubscribersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $status = ['ACTIVE', 'INACTIVE'];
        $type = ['PAID', 'UNPAID'];
        for ($i = 0; $i <= 40; $i++) {
           Subscriber::create([
                'email' => $faker->email(),
                'status' => $status[rand(0,1)],
                'type' => $type[rand(0,1)],
            ]);
        }
    }
}
