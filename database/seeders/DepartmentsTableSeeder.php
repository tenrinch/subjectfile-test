<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
use Illuminate\Support\Str;

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
                'slug' => Str::slug('TCRC', '-'),
            ],
            [
                'id'    => 2,
                'title' => 'Kashag',
                'slug' => Str::slug('Kashag', '-'),
            ],
            [
                'id'    => 3,
                'title' => 'TSJC',
                'slug' => Str::slug('TSJC', '-'),
            ],
            [
                'id'    => 4,
                'title' => 'TPiE',
                'slug' => Str::slug('TPiE', '-'),
            ],
            [
                'id'    => 5,
                'title' => 'Department of Home',
                'slug' => Str::slug('Department of Home', '-'),
            ]
        ];

        Department::insert($departments);
    }
}
