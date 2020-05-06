<?php

use App\Models\User;
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
        User::create([
            'nama'     => 'Admin Spatula',
            'username' => 'admin',
            'email'    => 'admin@mail.id',
            'password' => bcrypt('secret'),
            'role_id'  => '1'
        ]);
    }
}
