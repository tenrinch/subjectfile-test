<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            [
                'id'    => 1,
                'title' => 'TCRC',
            ],
            [
                'id'    => 2,
                'title' => 'Kashag',
            ],
            [
                'id'    => 3,
                'title' => 'TSJC',
            ],
            [
                'id'    => 4,
                'title' => 'TPiE',
            ],
            [
                'id'    => 5,
                'title' => 'Department of Home',
            ]
        ];

        Department::insert($departments);
    }
}
