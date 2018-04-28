<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        factory(App\NewsCategory::class, 10)->create();

        for ($i = 0; $i < 100; $i++) {
            $news = factory(App\News::class, 50)->create();

            $news->each(function ($item) use ($faker) {
                $item->attachTags($faker->words(rand(1,20), $asText = false));
            });
        }


        // $this->call(UsersTableSeeder::class);
    }
}
