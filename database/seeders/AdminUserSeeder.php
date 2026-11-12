<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = env('ADMIN_PASSWORD', 'iliya1234');

        User::updateOrCreate(
            ['email' => 'admin@iliya.dev'],
            [
                'name' => 'ایلیا پورزنجانی',
                'password' => Hash::make($password),
            ]
        );
    }
}
