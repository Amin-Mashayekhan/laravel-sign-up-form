<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
            'name' => 'محمد امین مشایخان',
            'email' => 'mashayekhan.mohammadamin@gmail.com',
            'phone_number' => '09156145545',
            'age' => 25,
            'password' => bcrypt('123456'),
            ],
        ]);

    }
}
