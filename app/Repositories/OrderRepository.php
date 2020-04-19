<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 19.04.2020
 * Time: 20:32
 */

namespace App\Repositories;


use App\Models\Order;
use App\Models\Product;
use App\Repositories\Interfaces\IOrderRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class OrderRepository implements IOrderRepository
{

    public function findById(int $id): ?Order
    {
        try {
            $order = Order::findOrFail($id);
            return $order;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function all(): Collection
    {
        try {
            $orders = Order::all();
            return $orders;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function create(array $data): ?Order
    {
        try {
            DB::beginTransaction();
            $order = new Order();
            $order->user_id = $data['user_id'];
            $order->total = $data['total'];
            $order->address = $data['address'];
            $order->save();

            foreach ($data['items'] as $item) {
                $product = Product::find($item->id);
                $order->items()->create([
                    'product_id' => $item->id,
                    'quantity' => $item->quantity,
                    'price' => $product->price,
                ]);
            }
            DB::commit();
            return $order;
        } catch (\Exception $ex) {
            DB::rollBack();
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }
}