<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $categories = Category::all();
        $images = [
            'blog1.png',
            'blog2.png',
            'blog3.png',
            'blog4.png',
            'blog5.png',
            'blog6.png',
            'blog7.png',
            'blog8.png',
            'blog9.png',
            'blog10.png',
        ];

        if (!$user) {
            return;
        }

        if ($categories->isEmpty()) {
            return;
        }

        foreach (range(1, 30) as $i) {
            Blog::create([
                'title' => fake()->sentence(6),
                'content' => fake()->paragraph(),
                'image' => fake()->randomElement($images),
                'user_id' => $user->id,
                'category_id' => $categories->random()->id,
                'status' => fake()->randomElement(['published']),
                'slug' => fake()->slug(),
            ]);
        }
    }
}
