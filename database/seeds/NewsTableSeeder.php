<?php

use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\User::all();
        $users->each(function($user) {
            $user->news()->saveMany(factory(App\News::class, 20)->make());
        });
    }
}
