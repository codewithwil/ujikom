<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name'      => 'admin',
            'email'     => 'admin@gmail.com',
            'password'  =>  bcrypt('12345678'),
        ]);
        $admin->assignRole('admin');

        $manager = User::create([
            'name'      => 'manager',
            'email'     => 'manager@gmail.com',
            'password'  =>  bcrypt('12345678'),
        ]);
        $manager->assignRole('manager');

        $supervisor = User::create([
            'name'      => 'supervisor',
            'email'     => 'supervisor@gmail.com',
            'password'  =>  bcrypt('12345678'),
        ]);
        $supervisor->assignRole('supervisor');

        $petugas = User::create([
            'name'      => 'petugas',
            'email'     => 'petugas@gmail.com',
            'password'  =>  bcrypt('12345678'),
        ]);
        $petugas->assignRole('petugas');


    }
}
