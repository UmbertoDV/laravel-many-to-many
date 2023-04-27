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
            $category = new Tag();
            $category->label = $label;
            $category->color = $faker->hexColor();
            $category->save();
        }
    }
}