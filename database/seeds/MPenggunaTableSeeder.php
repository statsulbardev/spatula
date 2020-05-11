<?php

use App\Models\m_pengguna;
use Illuminate\Database\Seeder;

class MPenggunaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        m_pengguna::create([
            'nama'     => 'Admin Spatula',
            'username' => 'admin',
            'email'    => 'admin@mail.id',
            'password' => bcrypt('secret'),
            'role_id'  => '1',
            'aktif'    => 1
        ]);
    }
}
