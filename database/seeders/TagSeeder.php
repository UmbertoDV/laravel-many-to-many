<?php

namespace Database\Seeders;

use Faker\Generator as Faker;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $labels = ["HTML", "CSS", "SQL", "Javascript", "PHP", "GIT", "Blade"];

        foreach($labels as $label){
            $tag = new Tag();
            $tag->label = $label;
            $tag->color = $faker->hexColor();
            $tag->save();
        }
    }
}