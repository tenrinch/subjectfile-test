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
            ],
            [
                'id'    => 6,
                'title' => 'Religion',
                'slug' => Str::slug('Religion', '-'),
            ],
            [
                'id'    => 7,
                'title' => 'PSC',
                'slug' => Str::slug('PSC', '-'),
            ],
            [
                'id'    => 8,
                'title' => 'Sherig',
                'slug' => Str::slug('Sherig', '-'),
            ],
            [
                'id'    => 9,
                'title' => 'Election',
                'slug' => Str::slug('Election', '-'),
            ],
            [
                'id'    => 10,
                'title' => 'DIIR',
                'slug' => Str::slug('DIIR', '-'),
            ],
            [
                'id'    => 11,
                'title' => 'Security',
                'slug' => Str::slug('Security', '-'),
            ],
            [
                'id'    => 12,
                'title' => 'Health',
                'slug' => Str::slug('Health', '-'),
            ],
            [
                'id'    => 13,
                'title' => 'Audit',
                'slug' => Str::slug('Audit', '-'),
            ],
            [
                'id'    => 14,
                'title' => 'Finance',
                'slug' => Str::slug('Finance', '-'),
            ],
            [
                'id'    => 15,
                'title' => 'TPI',
                'slug' => Str::slug('TPI', '-'),
            ]

        ];

        Department::insert($departments);
    }
}
