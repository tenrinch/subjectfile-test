<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategorySeeder::class,
            SenderDestinationSeeder::class,
            IncomingSeeder::class,
            OutgoingSeeder::class,
        ]);
    }
}
