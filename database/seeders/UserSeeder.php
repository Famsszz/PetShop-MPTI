<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'Nama_Akun' => 'admin',
            'Nama_Pengguna' => 'Admin User',
            'password' => Hash::make('password'), // ganti 'password' dengan kata sandi yang diinginkan
            'No_Telp' => '123456789',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'reset_token' => null,
            'Peran' => 'Admin',
            'Dibuat' => now()
        ]);

        DB::table('users')->insert([
            'Nama_Akun' => 'customer',
            'Nama_Pengguna' => 'Customer User',
            'password' => Hash::make('password'), // ganti 'password' dengan kata sandi yang diinginkan
            'No_Telp' => '987654321',
            'email' => 'customer@example.com',
            'email_verified_at' => now(),
            'reset_token' => null,
            'Peran' => 'Pelanggan',
            'Dibuat' => now()
        ]);

        DB::table('users')->insert([
            'Nama_Akun' => 'kasir',
            'Nama_Pengguna' => 'kasir User',
            'password' => Hash::make('password'), // ganti 'password' dengan kata sandi yang diinginkan
            'No_Telp' => '1111111111',
            'email' => 'kasir@example.com',
            'email_verified_at' => now(),
            'reset_token' => null,
            'Peran' => 'kasir',
            'Dibuat' => now()
        ]);

        DB::table('users')->insert([
            'Nama_Akun' => 'owner',
            'Nama_Pengguna' => 'owner',
            'password' => Hash::make('password'), // ganti 'password' dengan kata sandi yang diinginkan
            'No_Telp' => '082387776991',
            'email' => 'owner@gmail.com',
            'email_verified_at' => now(),
            'reset_token' => null,
            'Peran' => 'admin',
            'Dibuat' => now()
        ]);
    }
}
