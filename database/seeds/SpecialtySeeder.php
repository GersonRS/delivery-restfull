<?php

use App\Establishment;
use App\Specialty;
use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Specialty::class)->createMany([
            ['name' => 'Pizza'],
            ['name' => 'Lanche'],
            ['name' => 'Mercado'],
            ['name' => 'Doce'],
            ['name' => 'Bebida'],
            ['name' => 'Almoço'],
            ['name' => 'Janta'],
            ['name' => 'Japonesa'],
            ['name' => 'Brasileira'],
            ['name' => 'Chinesa'],
            ['name' => 'Saudável'],
            ['name' => 'Árabe'],
            ['name' => 'Sorvete'],
            ['name' => 'Cozinha Rápida'],
            ['name' => 'Frutos do Mar'],
            ['name' => 'Mexicana'],
            ['name' => 'Vegetariana'],
            ['name' => 'Italiana'],
            ['name' => 'Poke'],
            ['name' => 'Espetinhos'],
            ['name' => 'Hot Dog'],
            ['name' => 'Carnes'],
            ['name' => 'Açai'],
            ['name' => 'Bolos'],
            ['name' => 'Salgados'],
            ['name' => 'Marmita'],
            ['name' => 'Contemporânea'],
            ['name' => 'Pastel'],
            ['name' => 'Francesa'],
            ['name' => 'Asiática'],
            ['name' => 'Padarias'],
            ['name' => 'Cafeterias'],
            ['name' => 'Alemã'],
            ['name' => 'Portuguesa'],
            ['name' => 'Mediterrâne'],
            ['name' => 'Congelados'],
            ['name' => 'Conveniência'],
            ['name' => 'Peruana'],
            ['name' => 'Sucos'],
            ['name' => 'Sopas'],
            ['name' => 'Caldos'],
        ])->each(function (Specialty $specialty){
            $specialty->establishments()->save(Establishment::all()->random());
        });
        for ($i = 1; $i <= 100; $i++) {
            $specialty = Specialty::all()->random();
            $specialty->establishments()->save(Establishment::all()->random());
        }
    }
}
