<?php

namespace Database\Seeders;

use App\Models\Admins;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admins::create([
            'username' => 'abdi33',
            'password' => '333333',
            'fullname' => 'Wisnu Wicaksono',
            'gender' => 'M',
            'address' => 'Jalan Kencana',
            'phone' => '028182812',
            'photo' => '',
        ]);
    }
}
