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
        // Trucating this modal all records. Just for testing purpose. Actually, this is not good habbits to truncate tables records.
        App\User::truncate();
        factory(App\User::class, 1)->create();
    }
}
