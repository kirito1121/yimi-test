<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
// use Faker\Generator as Faker;

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
$fakerVN = Faker\Factory::create('vi_VN');

$status_order = ['new', 'comfirmed', 'doing', 'done', 'received', 'finish'];

$factory->define(App\User::class, function (Faker\Generator $faker) use ($fakerVN) {
    return [
        'name' => $fakerVN->name,
        'email' => $fakerVN->email,
        'password' => '123456',
    ];
});
$factory->define(App\Staff::class, function (Faker\Generator $faker) use ($fakerVN) {
    return [
        'name' => $fakerVN->name,
        'email' => $fakerVN->email,
    ];
});
$factory->define(App\Customer::class, function (Faker\Generator $faker) use ($fakerVN) {
    return [
        'name' => $fakerVN->name,
        'email' => $fakerVN->email,
    ];
});

$factory->define(App\Store::class, function (Faker\Generator $faker) use ($fakerVN) {
    return [
        'name' => $fakerVN->name,
        'address' => $fakerVN->address,
    ];
});

$factory->define(App\Order::class, function (Faker\Generator $faker) use ($fakerVN, $status_order) {
    return [
        'no' => $fakerVN->numerify(),
        'amount' => 0,
        'status' => $status_order[array_rand($status_order)],
        'staff_id' => rand(1, 5),
        'customer_id' => rand(1, 5),
        'store_id' => 1,
    ];
});
