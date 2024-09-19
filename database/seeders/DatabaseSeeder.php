<?php

namespace Database\Seeders;

use App\Models\Bookmark;
use App\Models\User;
use App\Models\Video;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()
            ->count(3) // Create 3 users
            ->create()
            ->each(function ($user) {
                // For each user, attach 3 videos to the bookmarkedVideos relationship
                $user->bookmarkedVideos()->attach(
                    Video::factory()->count(3)->create()->pluck('id')->toArray()
                );
            });
    }
}
