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
        // Faker
        $faker = Faker\Factory::create();
        // Array (statuses)
        $status = ['ACTIVE', 'INACTIVE', 'UNPAID'];
        // Save data
//        for ($i = 0; $i <= 40; $i++) {
//           Subscriber::create([
//                'email' => $faker->email(),
//                'status' => $status[rand(0,2)],
//            ]);
//        }
        // My acc
        Subscriber::create([
            'email' => 'nikolaidjos@gmail.com',
            'status' => 'ACTIVE',
        ]);
    }
}
