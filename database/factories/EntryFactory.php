<?php

use Faker\Generator as Faker;





$factory->define(App\Entry::class, function (Faker $faker) {
    return [
        'creation_date' => now(),
        'title' => 'Mock entry',
        'content' => 'This is random post :)', // secret
        'author' => 0
    ];
});
