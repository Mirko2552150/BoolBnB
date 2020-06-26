<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // php artisan db:seed per far partire tutti questi seeder a cascata
        $this->call(HomesTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(StatsTableSeeder::class);
        $this->call('HomesTableSeeder');
        // php artisan db:seed --class=StatsTableSeeder per far partire solo il singolo seeder
    }
}
