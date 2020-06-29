<?php

use Illuminate\Database\Seeder;

class LikesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $news = \App\News::all();
        $news->each(function ($news) {
            $rand = random_int(3, 10);
            $users = \App\User::all()->random($rand);
            $news->increment('like_count', $rand);
            $users->each(function ($user) use ($news) {
               \App\NewsLike::insert([
                   'user_id' => $user->id,
                   'news_id' => $news->id
               ]);
            });
        });
        $photos = \App\Photo::all();
        $photos->each(function ($photo) {
            $rand = random_int(3, 5);
            $users = \App\User::all()->random($rand);
            $photo->increment('like_count', $rand);
            $users->each(function ($user) use ($photo) {
                \App\PhotoLike::insert([
                    'user_id' => $user->id,
                    'photo_id' => $photo->id
                ]);
            });
        });
    }
}
