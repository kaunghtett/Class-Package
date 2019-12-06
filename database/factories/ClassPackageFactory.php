<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ClassPackage;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(ClassPackage::class, function (Faker $faker) {
    $packnames = [
        '10 Class Pack',
        '20 Class Pack',
        '30 Class Pack',
        '40 Class Pack',
        '30 Class Pack',
    ];

    $packstype = ['non_shareable','shareable'];
    $packs = ['20 packs','30 packs','40 packs','50 packs'];

    $tags = [
        'null',
        'New'
    ];

    return [
        'pack_id' => Str::random(10),
        'pack_name' =>  $packnames[rand(0, count($packnames) - 1)],
        'pack_description' => $faker->text,
        'pack_type'=> $packstype[rand(0,count($packstype) -1)],
        'total_credit' => $faker->numberBetween(0,80),
        'tag_name' => $tags[rand(0,count($tags) -1)],
        'validity_month' => $faker->numberBetween(0,12),
        'pack_price' => $faker->numberBetween(0,12),
        'newbie_first_attend' => $faker->boolean(),
        'newbie_addition_credit' => $faker->numberBetween(0,10),
        'newbie_note' => $faker->paragraph(),
        'pack_alias' => $packs[rand(0,count($packs) -1)], 
        'estimate_price' => $faker->numberBetween(0,12),
    ];
});




