<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create ([
            'name'  => 'Maninder Kumar',
            'email' => 'maninder.k@mintm.com',
            'password' => bcrypt('maninder@123')
        ]);

        User::create ([
            'name'  => 'Richard Murphy',
            'email' => 'richard.murphy@morecorp.net',
            'password' => Hash::make('richard@123')
        ]);
    }
}
