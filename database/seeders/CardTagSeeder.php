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
        $tags = Tag::all()->pluck('id');

        for($i = 1; $i > 40; $i++){
            $card = Card::find($i);
            $card->tags()->attach($faker->randomElements($tags, 3));
        }
    }
}