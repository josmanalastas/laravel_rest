<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productIDs = DB::table('products')->pluck('id');
        $faker = Faker::create();
        foreach(range(1, 30) as $index) {
            DB::table('reviews')->insert([
                'customer_review' => $faker->sentence,
                'product_id' => $faker->randomElement($productIDs),
                'created_at' => Carbon::now()
            ]);
        }
    }
}
