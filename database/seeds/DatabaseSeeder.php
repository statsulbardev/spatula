<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            MPenggunaTableSeeder::class,
            MSatkerTableSeeder::class,
            MLayananTableSeeder::class,
            MSaranTableSeeder::class,
            MAksesTableSeeder::class,
            DPenilaianTableSeeder::class,
        ]);
    }
}
