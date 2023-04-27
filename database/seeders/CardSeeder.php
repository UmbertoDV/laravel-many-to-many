<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Category;

use Illuminate\Support\Str;

use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $categories = Category::all()->pluck('id');
        $categories[] = null;
        
        for($i = 0; $i < 40; $i++){
            $card = new Card;
            $card->category_id = $faker->randomElement($categories);
            $card->title = $faker->catchPhrase();
            $card->slug = Str::of($card->title)->slug('-');
            // $card->image = $faker->imageUrl(640, 470, 'animals', true);
            $card->text = $faker->paragraph(15);
            $card->save();
        }
    }
}