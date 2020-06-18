<?php

use App\Category;
use App\Establishment;
use App\Opening;
use Illuminate\Database\Seeder;

class EstablishmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Establishment::class,10)->create()->each(function(Establishment $establishment){
            $establishment->categories()->createMany(factory(Category::class,2)->make()->toArray());
            $establishment->opening()->createMany(factory(Opening::class,5)->make()->toArray());
        });
    }
}
