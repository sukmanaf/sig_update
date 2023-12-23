<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Permission::create(['name'=>'tambah']);
        Permission::create(['name'=>'edit']);
        Permission::create(['name'=>'lihat']);
        Permission::create(['name'=>'hapus']);
        
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'kota']);
        Role::create(['name' => 'desa']);

        $roleAdmin = Role::findByName('admin');
        $roleAdmin->givePermissionTo('tambah');
        $roleAdmin->givePermissionTo('edit');
        $roleAdmin->givePermissionTo('hapus');
        $roleAdmin->givePermissionTo('lihat');
        
        $roleAdmin = Role::findByName('kota');
        $roleAdmin->givePermissionTo('tambah');
        $roleAdmin->givePermissionTo('edit');
        $roleAdmin->givePermissionTo('hapus');
        $roleAdmin->givePermissionTo('lihat');
        
        $roleAdmin = Role::findByName('kota');
        $roleAdmin->givePermissionTo('lihat');


    }
}
