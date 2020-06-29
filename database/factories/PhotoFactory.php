<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Photo::class, function (Faker $faker) {
    $photos = [
        'devushka_brunetka_ruki_8301.jpg',
        'igra_Dota_2_Natures_Prophet_3806.jpg',
        'multfilm_lyagushka_32117.jpg',
        'multfilm_minion_Gubka_Bob_Patrick_Star_15610.jpg',
        'ogon_tigr_9115.jpg',
        'zhivotnye_ptica_shlyapa_cyplyonok_7928.jpg',
    ];
    return [
        'url' => $photos[array_rand($photos)]
    ];
});
