<?php

namespace Database\Seeders;

use App\Models\Category;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $labels = ["HTML-5", "CSS-3", "JavaScript", "PHP", "GIT"];

        foreach($labels as $label){
            $category = new Category();
            $category->label = $label;
            $category->color = $faker->hexColor();
            $category->save();
        }
    }
}