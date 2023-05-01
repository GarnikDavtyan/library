<?php

namespace Database\Seeders;

use App\Models\Category;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 20; $i++) {
            $title = $faker->sentence(3);
            $slug = Str::slug($title);
            
            while(Category::where('slug', $slug)->first()) {
                $slug .= '-'. strtolower(Str::random(3));
            }

            Category::create([
                'title' => $title,
                'slug' => $slug
            ]);
        }
    }
}
