<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('=== Starting Database Seeding ===');
        
        // Create admin user
        $admin = User::where('email', 'admin@spms.com')->first();
        
        if (!$admin) {
            User::create([
                'name' => 'System Administrator',
                'email' => 'admin@spms.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ]);
            $this->command->info('✅ Admin user created successfully!');
            $this->command->info('   Email: admin@spms.com');
            $this->command->info('   Password: admin123');
        } else {
            $this->command->info('⚠️ Admin user already exists');
            $this->command->info('   Email: ' . $admin->email);
        }
        
        $this->command->info('=== Database Seeding Completed ===');
    }
}