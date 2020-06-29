<?php

use Illuminate\Database\Seeder;

class PhotoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $news = App\News::all();
        $news->each(function ($news) {
            $rand = random_int(1, 5);
            $news->photos()->saveMany(factory(App\Photo::class, $rand)->make());
        });
    }
}
