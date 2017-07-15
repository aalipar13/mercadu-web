<?php

use App\Common\Models\UserDetail;

use Illuminate\Database\Seeder;

class UserDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserDetail::create([
            'user_id' => 1,
            'first_name' => 'Administrator',
            'last_name' => 'Administrator',
            'mobile' => '0900000000',
            'is_account_verified' => 'yes',
            'bank_account_number' => '102070061111'
        ]);

        UserDetail::create([
            'user_id' => 2,
            'first_name' => 'Customer',
            'last_name' => 'Customer',
            'mobile' => '09888888',
            'is_account_verified' => 'yes',
            'bank_account_number' => '102070061876',
            'reward_points' => 2
        ]);

        UserDetail::create([
            'user_id' => 3,
            'first_name' => 'Merchant',
            'last_name' => 'Merchant',
            'mobile' => '0944444444',
            'is_account_verified' => 'yes',
            'bank_account_number' => '101033520667'
        ]);

        $this->command->info('User details seeded!');
    }
}
