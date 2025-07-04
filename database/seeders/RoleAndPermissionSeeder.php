<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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

        // Create permissions
        Permission::create(['name' => 'manage deposits']);
        Permission::create(['name' => 'manage transactions']);
        Permission::create(['name' => 'manage funds']);
        Permission::create(['name' => 'manage division cash']);
        Permission::create(['name' => 'view reports']);
        Permission::create(['name' => 'manage users']);

        // Create roles and assign existing permissions
        $bendahara = Role::create(['name' => 'bendahara']);
        $bendahara->givePermissionTo([
            'manage deposits',
            'manage transactions', 
            'manage funds',
            'manage division cash',
            'view reports',
            'manage users'
        ]);

        $ketua = Role::create(['name' => 'ketua']);
        $ketua->givePermissionTo([
            'view reports',
            'manage division cash'
        ]);

        $sekretaris = Role::create(['name' => 'sekretaris']);
        $sekretaris->givePermissionTo([
            'view reports'
        ]);

        $anggota = Role::create(['name' => 'anggota']);
        $anggota->givePermissionTo([
            'view reports'
        ]);

        // Create default users
        $bendaharaUser = User::create([
            'name' => 'Bendahara HMIF',
            'email' => 'bendahara@hmif.unsoed.ac.id',
            'password' => bcrypt('password'),
            'email_verified_at' => now()
        ]);
        $bendaharaUser->assignRole('bendahara');

        $ketuaUser = User::create([
            'name' => 'Ketua HMIF',
            'email' => 'ketua@hmif.unsoed.ac.id',
            'password' => bcrypt('password'),
            'email_verified_at' => now()
        ]);
        $ketuaUser->assignRole('ketua');

        $sekretarisUser = User::create([
            'name' => 'Sekretaris HMIF',
            'email' => 'sekretaris@hmif.unsoed.ac.id',
            'password' => bcrypt('password'),
            'email_verified_at' => now()
        ]);
        $sekretarisUser->assignRole('sekretaris');

        $anggotaUser = User::create([
            'name' => 'Anggota HMIF',
            'email' => 'anggota@hmif.unsoed.ac.id',
            'password' => bcrypt('password'),
            'email_verified_at' => now()
        ]);
        $anggotaUser->assignRole('anggota');
    }
}
