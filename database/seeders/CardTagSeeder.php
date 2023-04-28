<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Tag;

use Faker\Generator as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CardTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $cards = Card::all();
        $tags = Tag::all()->pluck('id')->toArray();

        foreach($cards as $card) {
            $card->tags()->attach($faker->randomElements($tags, random_int(0, 3)));
        }
    }
}