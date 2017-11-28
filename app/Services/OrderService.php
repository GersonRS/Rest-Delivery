<?php
/**
 * Created by PhpStorm.
 * User: gerson
 * Date: 28/11/17
 * Time: 09:15
 */

namespace Delivery\Services;


use Delivery\Models\Cupom;
use Delivery\Models\Order;
use Delivery\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function create(array $data)
    {
        DB::beginTransaction();
        try{
            if(isset($data['cupom'])){
                $cupom = Cupom::where('code',$data['cupom'])->first();
                $data['cupom_id'] = $cupom->id;
                $cupom->used = 1;
                $cupom->save();
                unset($data['cupom']);
            }
            $items = json_decode($data['items'],true);
            unset($data['items']);
            $data['total'] = 0;
            $order = factory(Order::class)->create($data);
            $total = 0;
            foreach($items as $item) {
                $item['price'] = Product::find($item['id'])->price * $item['amount'];
                $item['product_id'] = $item['id'];
                unset($item['id']);
                $order->items()->create($item);
                $total += $item['price'];
            }
            $order->total = $total;
            if (isset($cupom)) {
                if ($cupom->type=='percent')
                    $order->total = $total - ($total * $cupom->value);
                else
                    $order->total = $total - $cupom->value;
            }
            $order->save();
            DB::commit();
            return $order;
        }catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

}