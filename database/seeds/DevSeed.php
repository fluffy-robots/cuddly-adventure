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

        $user = new User();
        $user->name = "Morten";
        $user->email = "moorten@gmail.com";
        $user->password = bcrypt('password');
        $user->save();

        $user = new User();
        $user->name = "Jonas";
        $user->email = "jb1497@gmail.com";
        $user->password = bcrypt('password');
        $user->save();

        $user = new User();
        $user->name = "Lasse";
        $user->email = "lasloukonen@gmail.com";
        $user->password = bcrypt('password');
        $user->save();
    }
}
