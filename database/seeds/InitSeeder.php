<?php

use Illuminate\Database\Seeder;

class InitSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $user = \App\User::create(['name' => 'abdou', 'email' => 'abdulrahman@toptal.com', 'password' => bcrypt('abdou')]);
        $role = \App\Role::create(['name' => 'admin', 'display_name' => 'Administrator', 'description' => 'A system administrator']);
        $user->attachRole($role);
    }

}
