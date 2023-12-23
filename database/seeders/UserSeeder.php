<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create(['name' => 'admin','email' => 'admin@email.com','password'=> bcrypt('123')]);
        $admin->assignRole('admin');
        $kota = User::create(['name' => 'kota','email' => 'kota@email.com','password'=> bcrypt('123')]);
        $kota->assignRole('kota');
        $desa = User::create(['name' => 'desa','email' => 'desa@email.com','password'=> bcrypt('123')]);
        $desa->assignRole('desa');
    }
}
