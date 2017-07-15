<?php

use App\User;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'admin@mercadu.ph',
            'username' => 'admin',
            'password' => 'passw0rth',
            'type' => 'admin'
        ]);

        $this->command->info('Admin seeded!');
    }
}
