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
                'email'          => 'admin@tibet.net',
                'password'       => bcrypt('password'),
                'department_id'  => 1,
                'remember_token' => null,
            ],
            [  
                'id'             => 7,
                'name'           => 'TSJC Staff',
                'email'          => 'tsjc-staff@tibet.net',
                'password'       => bcrypt('tsjc-staff'),
                'department_id'  => 3,
                'remember_token' => null,
            ],
            [
                'id'             => 8,
                'name'           => 'Tpie Staff',
                'email'          => 'tpie-staff@tibet.net',
                'password'       => bcrypt('tpie-staff'),
                'department_id'  => 4,
                'remember_token' => null,
            ],
            [
                'id'             => 9,
                'name'           => 'Kashag Staff',
                'email'          => 'kashag-staff@tibet.net',
                'password'       => bcrypt('kashag-staff'),
                'department_id'  => 2,
                'remember_token' => null,
            ],
            [
                'id'             => 10,
                'name'           => 'home-staff',
                'email'          => 'home-staff@tibet.net',
                'password'       => bcrypt('home-staff'),
                'department_id'  => 5,
                'remember_token' => null,
            ],
            [  
                'id'             => 11,
                'name'           => 'Religion Staff',
                'email'          => 'religion-staff@tibet.net',
                'password'       => bcrypt('religion-staff'),
                'department_id'  => 6,
                'remember_token' => null,
            ],
            [
                'id'             => 12,
                'name'           => 'psc-staff',
                'email'          => 'psc-staff@tibet.net',
                'password'       => bcrypt('psc-staff'),
                'department_id'  => 7,
                'remember_token' => null,
            ],
            [
                'id'             => 13,
                'name'           => 'diir-staff',
                'email'          => 'diir-staff@tibet.net',
                'password'       => bcrypt('diir-staff'),
                'department_id'  => 10,
                'remember_token' => null,
            ],
            [
                'id'             => 14,
                'name'           => 'election-staff',
                'email'          => 'election-staff@tibet.net',
                'password'       => bcrypt('election-staff'),
                'department_id'  => 9,
                'remember_token' => null,
            ],
            [  
                'id'             => 15,
                'name'           => 'security-staff',
                'email'          => 'security-staff@tibet.net',
                'password'       => bcrypt('security-staff'),
                'department_id'  => 11,
                'remember_token' => null,
            ],
            [
                'id'             => 16,
                'name'           => 'health-staff',
                'email'          => 'health-staff@tibet.net',
                'password'       => bcrypt('health-staff'),
                'department_id'  => 12,
                'remember_token' => null,
            ],
            [
                'id'             => 17,
                'name'           => 'audit-staff',
                'email'          => 'audit-staff@tibet.net',
                'password'       => bcrypt('audit-staff'),
                'department_id'  => 13,
                'remember_token' => null,
            ],
            [
                'id'             => 18,
                'name'           => 'sherig-staff',
                'email'          => 'sherig-staff@tibet.net',
                'password'       => bcrypt('sherig-staff'),
                'department_id'  => 8,
                'remember_token' => null,
            ],
             [
                'id'             => 19,
                'name'           => 'finance-staff',
                'email'          => 'finance-staff@tibet.net',
                'password'       => bcrypt('finance-staff'),
                'department_id'  => 14,
                'remember_token' => null,
            ],
            [
                'id'             => 20,
                'name'           => 'tcrc-staff',
                'email'          => 'tcrc-staff@tibet.net',
                'password'       => bcrypt('tcrc-staff'),
                'department_id'  => 1,
                'remember_token' => null,
            ],
            [
                'id'             => 23,
                'name'           => 'tpi-staff',
                'email'          => 'tpi-staff@tibet.net',
                'password'       => bcrypt('tpi-staff'),
                'department_id'  => 15,
                'remember_token' => null,
            ],
        ];
        User::insert($users);
    }
}
