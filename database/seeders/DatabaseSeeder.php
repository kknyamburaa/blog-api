<?php

namespace Database\Seeders;


use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {    
        User::factory(15)->create();
        Category::factory(5)->create();
        Post::factory(50)->create();
        Comment::factory(100)->create();
        Like::factory(200)->create();
    }
}
