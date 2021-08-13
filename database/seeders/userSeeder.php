<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::truncate();
     User::create([	
     		 'name' => 'admin',
             'level' => 'admin',
             'email' => 'admin@admin.com',
             'password' => bcrypt('admin'),
             'remember_token' => Str::random(60),
         ]);
 	}
}
