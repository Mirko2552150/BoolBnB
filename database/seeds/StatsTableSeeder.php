<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Home;
use App\User;
use App\Service;
use App\InfoUser;
use App\Message;
use App\Stat;
use Carbon\Carbon;

class StatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
      for ($i=0; $i < 1000; $i++) {
        $now = Carbon::now();
        $home = Home::inRandomOrder()->first(); // prendiamo random uno user
        $stat = new Stat;
        $stat->home_id = $home->id;
        $stat->created_at = $faker->dateTimeBetween('2020-01-01 20:52:14', $now);        // DateTime('2011-02-27 20:52:14', 'Africa/Lagos')
        $stat->save();

      }
    }
}
