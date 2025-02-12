<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                "id" => 1,
                "name" => "Ariful Islam",
                "email" => "arif@gmail.com",
                'password'=> Hash::make(12345678),
                "email_verified_at" => null,
                "created_at" => Carbon::parse('2025-02-12T09:20:22.000000Z'),
                "updated_at" => Carbon::parse('2025-02-12T09:20:22.000000Z'),
            ],
            [
                "id" => 2,
                "name" => "Tarif Hossain",
                "email" => "tarif@gmail.com",
                'password'=> Hash::make(12345678),
                "email_verified_at" => null,
                "created_at" => Carbon::parse('2025-02-12T10:01:45.000000Z'),
                "updated_at" => Carbon::parse('2025-02-12T10:01:45.000000Z'),
            ],
            [
                "id" => 3,
                "name" => "Parvej Hossain",
                "email" => "parvej@gmail.com",
                'password'=> Hash::make(12345678),
                "email_verified_at" => null,
                "created_at" => Carbon::parse('2025-02-12T10:07:15.000000Z'),
                "updated_at" => Carbon::parse('2025-02-12T10:07:15.000000Z'),
            ],
        ];

        DB::table('users')->insert($users);
    }
}
