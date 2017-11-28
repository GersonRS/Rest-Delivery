<?php

use Illuminate\Database\Seeder;
use Delivery\Models\Order;
use Delivery\Models\OrderItem;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Order::class,10)->create()->each(function(Order $o){
            for ($i=0; $i <= 2 ; $i++) {
                $o->items()->save(factory(OrderItem::class)->make());
            }
        });
    }
}
