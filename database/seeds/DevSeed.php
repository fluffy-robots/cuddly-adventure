<?php

use Illuminate\Database\Seeder;

class DevSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Martin";
        $user->email = "admin@webkenth.dk";
        $user->password = bcrypt('password');
        $user->save();
    }
}
