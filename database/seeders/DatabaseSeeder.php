<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@spms.com')->first();
        
        if (!$admin) {
            User::create([
                'name' => 'System Administrator',
                'email' => 'admin@spms.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ]);
            $this->command->info('✅ Admin created: admin@spms.com / admin123');
        }
    }
}