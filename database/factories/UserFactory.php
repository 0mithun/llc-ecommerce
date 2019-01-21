<?php

use Carbon\Carbon;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name'                  =>  $this->faker->name('male'),
        'email'                 =>  $this->faker->email,
        'phone_number'          =>  $this->faker->phoneNumber,
        'password'              =>  bcrypt(123456),
        'email_verified_at'     =>  Carbon::now()

    ];
});
