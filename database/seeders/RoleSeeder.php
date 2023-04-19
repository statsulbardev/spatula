<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'superadmin',
            'admin',
            'pimpinan',
            'pj-layanan',
            'pj-pengaduan',
            'tim-zi',
            'operator'
        ];

        for ($i = 0; $i < count($data); $i++) {
            Role::create(['name' => $data[$i]]);
        }
    }
}
