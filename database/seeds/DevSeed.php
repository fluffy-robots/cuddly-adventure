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
        $role = new App\Role;
        $role->name = 'webshop';
        $role->label = 'Webshop';
        $role->save();

        $role = new App\Role;
        $role->name = 'manufacturer';
        $role->label = 'Manufacturer';
        $role->save();

        $role = new App\Role;
        $role->name = 'admin';
        $role->label = 'Administrator';
        $role->save();

        $permission = new App\Permission;
        $permission->name = 'awesome';
        $permission->label = 'awesome';
        $permission->save();

        $role->addPermission($permission);

        $user = new App\User();
        $user->name = "Martin";
        $user->email = "admin@webkenth.dk";
        $user->password = bcrypt('password');
        $user->save();
        $user->addRole($role);

        $user = new App\User();
        $user->name = "Morten";
        $user->email = "mooorten@gmail.com";
        $user->password = bcrypt('password');
        $user->save();
        $user->addRole($role);

        $user = new App\User();
        $user->name = "Jonas";
        $user->email = "jb1497@gmail.com";
        $user->password = bcrypt('password');
        $user->save();
        $user->addRole($role);

        $user = new App\User();
        $user->name = "Lasse";
        $user->email = "lasloukonen@gmail.com";
        $user->password = bcrypt('password');
        $user->save();
        $user->addRole($role);
    }
}
