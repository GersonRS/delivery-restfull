<?php

use App\Establishment;
use App\Opening;
use Illuminate\Database\Seeder;

class OpeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Opening::class,50)->create();
    }
}
