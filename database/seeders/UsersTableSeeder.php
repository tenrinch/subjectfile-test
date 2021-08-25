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
        ];

        User::insert($users);
    }
}
