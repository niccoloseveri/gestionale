<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();
        $adminRole=Role::where('name','admin')->first();
        $authorRole=Role::where('name','autore')->first();
        $userRole=Role::where('name','utente')->first();

        $admin = User::create([
            'name' => 'Utente Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password')
        ]);
        $author = User::create([
            'name' => 'Utente Autore',
            'email' => 'author@author.com',
            'password' => Hash::make('password')
        ]);
        $user = User::create([
            'name' => 'Utente Base',
            'email' => 'user@user.com',
            'password' => Hash::make('password')
        ]);
        $admin->roles()->attach($adminRole);
        $author->roles()->attach($authorRole);
        $user->roles()->attach($userRole);

    }
}
