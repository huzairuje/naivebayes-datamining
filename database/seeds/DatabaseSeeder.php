<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TruncateSeeder::class);
        $this->call(UsersAccessSeeder::class);
        $this->call(ScoringTableSeeder::class);
    }
}
