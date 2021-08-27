<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Outgoing;

class OutgoingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Outgoing::factory()
            ->count(50)
            ->create();
    }
}
