<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Home;
use App\User;
use App\Service;
use App\InfoUser;
use App\Message;


class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
      for ($i=0; $i < 100; $i++) {
        $home = Home::inRandomOrder()->first(); // prendiamo random uno user
        $message = new Message;
        $message->home_id = $home->id;
        $message->body = $faker->realText(100);
        $message->mail = $faker->email();
        $message->save();

      }
    }
}
