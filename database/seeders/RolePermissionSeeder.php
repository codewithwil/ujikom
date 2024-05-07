<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name'=>'admin']);
        Role::create(['name'=>'manager']);
        Role::create(['name'=>'supervisor']);
        Role::create(['name'=>'petugas']);

        Permission::create(['name'=>'lihat-user']);
        Permission::create(['name'=>'tambah-user']);
        Permission::create(['name'=>'edit-user']);
        Permission::create(['name'=>'hapus-user']);

        $roleAdmin = Role::findByName('admin');
        $roleAdmin->givePermissionTo('lihat-user');
        $roleAdmin->givePermissionTo('tambah-user');
        $roleAdmin->givePermissionTo('edit-user');
        $roleAdmin->givePermissionTo('hapus-user');

        $roleManager = Role::findByName('manager');
        $roleManager->givePermissionTo('lihat-user');
        $roleManager->givePermissionTo('tambah-user');
        $roleManager->givePermissionTo('edit-user');
        $roleManager->givePermissionTo('hapus-user');

        $roleSupervisor = Role::findByName('supervisor');
        $roleSupervisor->givePermissionTo('lihat-user');
        $roleSupervisor->givePermissionTo('tambah-user');
        $roleSupervisor->givePermissionTo('hapus-user');

        $rolePetugas = Role::findByName('petugas');
        $rolePetugas->givePermissionTo('lihat-user');
        $rolePetugas->givePermissionTo('tambah-user');
        $rolePetugas->givePermissionTo('hapus-user');
    }
}
