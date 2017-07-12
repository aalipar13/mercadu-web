<?php

use Illuminate\Database\Seeder;

use App\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(['email' => 'admin@merkadu.ph',
                      'password' => 'passw0rt',
                      'type' => 'admin']);

        $this->command->info('Admin seeded!');
    }
}
