<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles and assign existing permissions
        Role::create(['name' => 'bendahara']);
        Role::create(['name' => 'kreus']);
        Role::create(['name' => 'iltek']);
        Role::create(['name' => 'mikat']);

        // Create default users
        $bendaharaUser = User::create([
            'name' => 'Bendahara HMIF',
            'email' => 'bendahara@keuangan.com',
            'password' => Hash::make("password"),
            'email_verified_at' => now()
        ]);
        $bendaharaUser->assignRole('bendahara');

        $kreusUser = User::create([
            "name" => "Kreasi dan Usaha HMIF",
            "email" => "kreus@keuangan.com",
            "password" => Hash::make("password"),
            'email_verified_at' => now()
        ]);
        $kreusUser->assignRole("kreus");

        $iltekUser = User::create([
            "name" => "Keilmuan dan Teknologi HMIF",
            "email" => "iltek@keuangan.com",
            "password" => Hash::make("password"),
            'email_verified_at' => now()
        ]);
        $iltekUser->assignRole("iltek");

        $mikatUser = User::create([
            "name" => "Minat dan Bakat HMIF",
            "email" => "mikat@keuangan.com",
            "password" => Hash::make("password"),
            'email_verified_at' => now()
        ]);
        $mikatUser->assignRole("mikat");

    }
}
