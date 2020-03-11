<?php

use Illuminate\Database\Seeder;
use App\User;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        foreach(range(1, 10) as $i) {
            $users = User::all();
            factory(\App\Comment::class)->create(['user_id' => $users->random()]);
        }
    }
}
