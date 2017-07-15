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
            'user_id' => 2,
            'first_name' => 'Customer',
            'last_name' => 'Customer',
            'birth_date' => '1988-08-88',
            'mobile' => '09888888',
            'is_account_verified' => 'yes',
            'bank_account_number' => '102070061876',
            'reward_points' => 2
        ]);

        UserDetail::create([
            'user_id' => 3,
            'first_name' => 'Merchant',
            'last_name' => 'Merchant',
            'birth_date' => '1944-04-44',
            'mobile' => '0944444444',
            'is_account_verified' => 'yes',
            'bank_account_number' => '102070061678'
        ]);
    }
}
