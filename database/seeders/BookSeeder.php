<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $categories = Category::pluck('id')->toArray();

        for ($i = 0; $i < 50; $i++) {
            $title = $faker->sentence(3);
            $slug = Str::slug($title);
            
            while(Book::where('slug', $slug)->first()) {
                $slug .= '-'. strtolower(Str::random(3));
            }

            $imageUrl = 'https://via.placeholder.com/300x300.png?text=' . urlencode($title);
            $imageContent = file_get_contents($imageUrl);
            $imagePath = 'covers/' . $slug . '.png';
            Storage::put($imagePath, $imageContent);

            Book::create([
                'title' => $title,
                'slug' => $slug,
                'category_id' => $faker->randomElement($categories),
                'author' => $faker->name(),
                'description' => $faker->paragraph(3),
                'rating' => $faker->randomFloat(1, 1, 5),
                'cover' => 'storage/' . $imagePath,
            ]);
        }
    }
}
