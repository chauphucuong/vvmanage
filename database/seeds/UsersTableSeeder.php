<?php

use Illuminate\Database\Seeder;
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
        User::create([
            'name' => 'Giang Phan',
            'email' => 'phanxuangiang@vigilantsolutions.com',
            'password' => bcrypt('1'),
            'is_admin' => 1
        ]);
    }
}
