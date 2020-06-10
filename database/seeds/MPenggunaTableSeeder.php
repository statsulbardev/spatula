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
            'nama'           => 'Admin Spatula',
            'username'       => 'admin',
            'email'          => 'admin@mail.id',
            'password'       => bcrypt('secret'),
            'kode_satker_id' => 1,
            'role_id'        => 1,
            'aktif'          => 1
        ]);
        m_pengguna::create([
            'nama'           => 'Irnanda Mas Putri',
            'username'       => 'uti',
            'email'          => 'uti@mail.id',
            'bpsid'          => '340058302',
            'password'       => bcrypt('secret'),
            'kode_satker_id' => 1,
            'role_id'        => 7,
            'aktif'          => 1
        ]);
    }
}
