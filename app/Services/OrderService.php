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
use Delivery\Repositories\CupomRepository;
use Delivery\Repositories\OrderRepository;
use Delivery\Repositories\ProductRepository;
use Illuminate\Support\Facades\DB;

class OrderService
{
    private $orderRepository;
    private $cupomRepository;
    private $productRepository;

    public function __construct(
        OrderRepository $orderRepository,
        CupomRepository $cupomRepository,
        ProductRepository $productRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->cupomRepository = $cupomRepository;
        $this->productRepository = $productRepository;
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try{
            if(isset($data['cupom'])){
                $cupom = $this->cupomRepository->findByField('code',$data['cupom'])->first();
                $data['cupom_id'] = $cupom->id;
                $cupom->used = 1;
                $cupom->save();
                unset($data['cupom']);
            }
            $items = json_decode($data['items'],true);
            unset($data['items']);
            $data['total'] = 0;
            $order = $this->orderRepository->create($data);
            $total = 0;
            foreach($items as $item) {
                $item['price'] = $this->productRepository->find($item['id'])->price;
                $item['product_id'] = $item['id'];
                unset($item['id']);
                $order->items()->create($item);
                $total += $item['price'] * $item['amount'];
            }
            $order->total = $total;
            if (isset($cupom)) {
                if ($cupom->percent)
                    $order->total = $total - ($total * $cupom->value);
                else
                    $order->total = $total - $cupom->value;
            }
            $order->save();
            DB::commit();
            return $order;
        }catch (\Exception $e) {
            DB::rollback();
        }
    }

}