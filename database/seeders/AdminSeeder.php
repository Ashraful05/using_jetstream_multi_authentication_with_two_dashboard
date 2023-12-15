<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
           'name'=>'Admin',
           'email'=>'admin@gmail.com',
            'email_verified_at' => now(),
            'password'=>Hash::make('ashraful5'),
            'remember_token'=>Str::random(10)
        ]);
    }
}
