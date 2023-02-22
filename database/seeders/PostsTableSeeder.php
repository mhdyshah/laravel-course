<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Post One',
                'excerpt' => 'Summary Of Post One',
                'body' => 'Body Of Post One',
                'image_path' => 'Empty',
                'is_published' => false,
                'min_to_read' => 2
            ],
            [
                'title' => 'Post Two',
                'excerpt' => 'Summary Of Post Two',
                'body' => 'Body Of Post Two',
                'image_path' => 'Empty',
                'is_published' => false,
                'min_to_read' => 2
            ]
        ];

        foreach ($posts as $key => $value) {
            Post::create($value);
        }
    }
}