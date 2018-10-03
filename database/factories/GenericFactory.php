<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Client::class, function (Faker $faker) {
    $name = 'Briscoe Group';
    return [
        'name' => $name,
        'slug' => str_slug($name, '-'),
        'ad_server_id' => '6709371'
    ];
});

$factory->define(App\Campaign::class, function (Faker $faker) {
    return [
        'name' => 'Monthly BAU',
        'client_id' => 1
    ];
});

$factory->define(App\MediaPlan::class, function (Faker $faker) {
    return [
        'name' => 'January',
        'campaign_id' => 1
    ];
});

$factory->define(App\InsertionOrder::class, function (Faker $faker) {
    return [
        'name' => 'Flight One',
        'insertion_order_id' => 1
    ];
});

$factory->define(App\Creative::class, function (Faker $faker) {
    return [
        'ad_tag' => "<ins class='dcmads' style='display:inline-block;width:300px;height:250px'
        data-dcm-placement='N524402.2681017THEPERFORMANCEDES/B20368403.206556443'
        data-dcm-rendering-mode='iframe'
        data-dcm-https-only
        data-dcm-resettable-device-id=''
        data-dcm-app-id=''>
      <script src='https://www.googletagservices.com/dcm/dcmads.js'></script>
    </ins>"
    ];
});