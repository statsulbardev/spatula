<?php

namespace Database\Seeders;

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
            'nama'           => 'Superadmin',
            'username'       => 'superadmin',
            'email'          => 'superadmin@mail.id',
            'password'       => bcrypt('secret'),
            'kode_satker_id' => 1,
            'role_id'        => 1,
            'aktif'          => 1
        ]);

        m_pengguna::create([
            'nama'           => 'Admin 7600',
            'username'       => 'admin7600',
            'email'          => 'admin7600@mail.id',
            'password'       => bcrypt('secret'),
            'kode_satker_id' => 1,
            'role_id'        => 2,
            'aktif'          => 1
        ]);

        m_pengguna::create([
            'nama'           => 'Admin 7601',
            'username'       => 'admin7601',
            'email'          => 'admin7601@mail.id',
            'password'       => bcrypt('secret'),
            'kode_satker_id' => 2,
            'role_id'        => 2,
            'aktif'          => 1
        ]);

        m_pengguna::create([
            'nama'           => 'Admin 7602',
            'username'       => 'admin7602',
            'email'          => 'admin7602@mail.id',
            'password'       => bcrypt('secret'),
            'kode_satker_id' => 3,
            'role_id'        => 2,
            'aktif'          => 1
        ]);

        m_pengguna::create([
            'nama'           => 'Admin 7603',
            'username'       => 'admin7603',
            'email'          => 'admin7603@mail.id',
            'password'       => bcrypt('secret'),
            'kode_satker_id' => 4,
            'role_id'        => 2,
            'aktif'          => 1
        ]);

        m_pengguna::create([
            'nama'           => 'Admin 7604',
            'username'       => 'admin7604',
            'email'          => 'admin7604@mail.id',
            'password'       => bcrypt('secret'),
            'kode_satker_id' => 5,
            'role_id'        => 2,
            'aktif'          => 1
        ]);

        m_pengguna::create([
            'nama'           => 'Admin 7605',
            'username'       => 'admin7605',
            'email'          => 'admin7605@mail.id',
            'password'       => bcrypt('secret'),
            'kode_satker_id' => 6,
            'role_id'        => 2,
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
