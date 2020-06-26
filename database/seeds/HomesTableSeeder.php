<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Home;
use App\User;
use App\Service;
use App\InfoUser;
use App\Message;

class HomesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
      for ($i=0; $i < 100; $i++) {
        $user = User::inRandomOrder()->first(); // prendiamo random uno user
        $home = new Home;
        $home->user_id = $user->id;
        $home->name = $faker->company();
        $home->n_rooms = $faker->numberBetween($min = 1, $max = 20);
        $home->n_beds = $faker->numberBetween($min = 1, $max = 40);
        $home->n_bath = $faker->numberBetween($min = 1, $max = 20);
        $home->mq = $faker->numberBetween($min = 20, $max = 10000);
        $home->address = $faker->address();
        $home->long = $faker->longitude(-180, 180);
        $home->lat = $faker->latitude(-90, 90);
        $home->path = 'https://loremflickr.com/1106/400/house?random=' . $i;
        $home->save();
        $services = Service::inRandomOrder()->limit(2)->get();
                        $home->services()->attach($services);
      }
    }
}
