<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1, 5) as $index) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'username' => $faker->username,
                'password' => Hash::make('test'),
                'email' => $faker->email,
                'created_at' => Carbon\Carbon::now()
            ]);
        }
    }
}
