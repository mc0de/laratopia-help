<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $admin = User::factory()->create([
            'name'  => 'Admin',
            'email' => 'admin@admin.com',
        ]);

        $this->setUpData($admin);
    }

    public function setUpData(User $user)
    {
        // Create team for admin
        $user->ownedTeam()->create([
            'name' => 'Admin\'s Team',
        ]);

        // Add some packages
        Package::create(['name' => 'Package XX']);
        Package::create(['name' => 'Package YY']);

        // Add some users to assign to project
        User::factory(5)->create();
    }
}
