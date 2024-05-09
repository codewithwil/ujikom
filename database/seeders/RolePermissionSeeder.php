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
 

        Permission::create(['name'=>'lihat-user']);
        Permission::create(['name'=>'tambah-user']);
        Permission::create(['name'=>'edit-user']);
        Permission::create(['name'=>'hapus-user']);

        Permission::create(['name'=>'lihat-anggota']);
        Permission::create(['name'=>'tambah-anggota']);
        Permission::create(['name'=>'edit-anggota']);
        Permission::create(['name'=>'hapus-anggota']);

        Permission::create(['name'=>'lihat-saldo']);
        Permission::create(['name'=>'tambah-saldo']);
        Permission::create(['name'=>'edit-saldo']);
        Permission::create(['name'=>'hapus-saldo']);

        
        Permission::create(['name'=>'lihat-simpananKredit']);
        Permission::create(['name'=>'tambah-simpananKredit']);
        Permission::create(['name'=>'edit-simpananKredit']);
        Permission::create(['name'=>'hapus-simpananKredit']);


        Role::create(['name'=>'admin']);
        Role::create(['name'=>'manager']);
        Role::create(['name'=>'supervisor']);
        Role::create(['name'=>'petugas']);

        $roleAdmin = Role::findByName('admin');
        $roleAdmin->givePermissionTo('lihat-user');
        $roleAdmin->givePermissionTo('tambah-user');
        $roleAdmin->givePermissionTo('edit-user');
        $roleAdmin->givePermissionTo('hapus-user');
        $roleAdmin->givePermissionTo('lihat-anggota');
        $roleAdmin->givePermissionTo('tambah-anggota');
        $roleAdmin->givePermissionTo('edit-anggota');
        $roleAdmin->givePermissionTo('hapus-anggota');
        $roleAdmin->givePermissionTo('lihat-saldo');
        $roleAdmin->givePermissionTo('tambah-saldo');
        $roleAdmin->givePermissionTo('edit-saldo');
        $roleAdmin->givePermissionTo('hapus-saldo');
        $roleAdmin->givePermissionTo('lihat-simpananKredit');
        $roleAdmin->givePermissionTo('tambah-simpananKredit');
        $roleAdmin->givePermissionTo('edit-simpananKredit');
        $roleAdmin->givePermissionTo('hapus-simpananKredit');

        $roleManager = Role::findByName('manager');
        $roleManager->givePermissionTo('lihat-user');
        $roleManager->givePermissionTo('tambah-user');
        $roleManager->givePermissionTo('edit-user');
        $roleManager->givePermissionTo('hapus-user');
        $roleManager->givePermissionTo('lihat-anggota');
        $roleManager->givePermissionTo('tambah-anggota');
        $roleManager->givePermissionTo('edit-anggota');
        $roleManager->givePermissionTo('hapus-anggota');
        $roleManager->givePermissionTo('lihat-saldo');
        $roleManager->givePermissionTo('tambah-saldo');
        $roleManager->givePermissionTo('edit-saldo');
        $roleManager->givePermissionTo('hapus-saldo');
        $roleManager->givePermissionTo('lihat-simpananKredit');
        $roleManager->givePermissionTo('tambah-simpananKredit');
        $roleManager->givePermissionTo('edit-simpananKredit');
        $roleManager->givePermissionTo('hapus-simpananKredit');

        $roleSupervisor = Role::findByName('supervisor');
        $roleSupervisor->givePermissionTo('lihat-user');
        $roleSupervisor->givePermissionTo('tambah-user');
        $roleSupervisor->givePermissionTo('hapus-user');
        $roleSupervisor->givePermissionTo('lihat-anggota');
        $roleSupervisor->givePermissionTo('tambah-anggota');
        $roleSupervisor->givePermissionTo('edit-anggota');
        $roleSupervisor->givePermissionTo('hapus-anggota');
        $roleSupervisor->givePermissionTo('lihat-saldo');
        $roleSupervisor->givePermissionTo('lihat-simpananKredit');
        $roleSupervisor->givePermissionTo('tambah-simpananKredit');
        $roleSupervisor->givePermissionTo('edit-simpananKredit');
        $roleSupervisor->givePermissionTo('hapus-simpananKredit');

        $rolePetugas = Role::findByName('petugas');
        $rolePetugas->givePermissionTo('lihat-user');
        $rolePetugas->givePermissionTo('tambah-user');
        $rolePetugas->givePermissionTo('hapus-user');
        $rolePetugas->givePermissionTo('lihat-anggota');
        $rolePetugas->givePermissionTo('tambah-anggota');
        $rolePetugas->givePermissionTo('edit-anggota');
        $rolePetugas->givePermissionTo('hapus-anggota');
        $rolePetugas->givePermissionTo('lihat-saldo');
        $rolePetugas->givePermissionTo('lihat-simpananKredit');
        $rolePetugas->givePermissionTo('tambah-simpananKredit');
        $rolePetugas->givePermissionTo('edit-simpananKredit');
        $rolePetugas->givePermissionTo('hapus-simpananKredit');
    }
}