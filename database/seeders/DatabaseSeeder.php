<?php

namespace Database\Seeders;

use App\Models\Like;
use App\Models\User;
use App\Models\Reply;
use App\Models\Tag;
use App\Models\Question;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        
        User::factory(10)->create();
        Tag::factory(5)->create();
        Question::factory(50)->create();
        Reply::factory(50)->create()->each(function ($reply) {
            return $reply->like()->save(Like::factory()->make());
        });
    }
}
