<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SenderDestination;

class SenderDestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SenderDestination::factory()
            ->count(30)
            ->create();
    }
}
