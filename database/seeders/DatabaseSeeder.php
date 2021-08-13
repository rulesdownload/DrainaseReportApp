<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        $this->call(userSeeder::class);
        $this->call(problemSeeder::class);
        $this->call(tipeSeeder::class);
        $this->call(statusSeeder::class);
    }
}
