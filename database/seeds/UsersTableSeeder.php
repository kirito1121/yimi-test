<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Store::class, 2)->create();
        factory(App\User::class, 5)->create();
        factory(App\Staff::class, 10)->create();
        factory(App\Customer::class, 50)->create();
    }
}
