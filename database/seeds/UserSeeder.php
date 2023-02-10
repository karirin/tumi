<?php

use Illuminate\Database\Seeder;
use App\User;

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
            'name' => 'test_user',
            'password' => 'karirin3948',
        ]);

        User::create([
            'name' => 'test_user2',
            'password' => 'karirin3948',
        ]);

        User::create([
            'name' => 'test_user3',
            'password' => 'karirin3948',
        ]);
    }
}
