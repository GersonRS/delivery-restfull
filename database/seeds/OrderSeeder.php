<?php

use App\Availability;
use App\Complement;
use App\Item;
use App\Order;
use App\Product;
use App\Promotion;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Order::class, 10)->create()->each(function (Order $order) {
            $products = factory(Product::class, 2)->create()->each(function (Product $product) {
                $product->promotion()->save(factory(Promotion::class)->make());
                $product->availabilities()->createMany(factory(Availability::class, 5)->make()->toArray());
                $product->complements()
                    ->createMany(factory(Complement::class, 2)->make()->toArray())
                    ->each(function (Complement $complement) {
                        $complement->items()->createMany(factory(Item::class, 3)->make()->toArray());
                    });
            });
            $order->products()->saveMany($products, [['amount' => random_int(1, 100), 'price' => rand(10.00, 1000.00)],['amount' => random_int(1, 100), 'price' => rand(10.00, 1000.00)]]);
        });
    }
}
