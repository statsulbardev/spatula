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
            'name'        => 'Misnawati Mansur',
            'email'       => 'misna@bps.go.id',
            'bps_id'      => '340054318',
            'employee_id' => '1988'
        ]);
        User::create([
            'name'        => 'Syaifur Rijal',
            'email'       => 'syaifur.rijal@bps.go.id',
            'bps_id'      => '340056465',
            'employee_id' => '1990'
        ]);
    }
}
