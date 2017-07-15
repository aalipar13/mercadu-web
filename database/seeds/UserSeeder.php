<?php

use App\User;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
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

        User::create([
            'email' => 'customer@mercadu.ph',
            'username' => 'customer',
            'password' => 'passw0rth!t',
            'type' => 'customer'
        ]);

        User::create([
            'email' => 'merchant@mercadu.ph',
            'username' => 'merchant',
            'password' => 'passw0rthy',
            'type' => 'merchant'
        ]);

        $this->command->info('Users seeded!');
    }
}
