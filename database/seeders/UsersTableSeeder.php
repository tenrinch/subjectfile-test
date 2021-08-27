<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Department;

class UsersTableSeeder extends Seeder
{
    public function run()
    {   
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('password'),
                'department_id'  => 1,
                'remember_token' => null,
            ],
            [
                'id'             => 2,
                'name'           => 'Kashag',
                'email'          => 'kashag@tibet.net',
                'password'       => bcrypt('password'),
                'department_id'  => 2,
                'remember_token' => null,
            ],
            [
                'id'             => 3,
                'name'           => 'TSJC',
                'email'          => 'tsjc@tibet.net',
                'password'       => bcrypt('password'),
                'department_id'  => 3,
                'remember_token' => null,
            ],
            [
                'id'             => 4,
                'name'           => 'TPiE',
                'email'          => 'tpie@tibet.net',
                'password'       => bcrypt('password'),
                'department_id'  => 4,
                'remember_token' => null,
            ],
            [
                'id'             => 5,
                'name'           => 'Home',
                'email'          => 'home@tibet.net',
                'password'       => bcrypt('password'),
                'department_id'  => 5,
                'remember_token' => null,
            ],

        ];

        User::insert($users);
    }
}
