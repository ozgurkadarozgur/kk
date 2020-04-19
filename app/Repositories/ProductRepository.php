<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 19.04.2020
 * Time: 16:55
 */

namespace App\Repositories;


use App\Models\Product;
use App\Repositories\Interfaces\IProductRepository;
use Illuminate\Support\Collection;

class ProductRepository implements IProductRepository
{
    public function all(): Collection
    {
        try {
            $products = Product::all();
            return $products;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function create($data): ?Product
    {
        try {
            $product = new Product();
            $product->title = $data['title'];
            $product->category_id = $data['category_id'];
            $product->description = $data['description'];
            $product->price = $data['price'];
            $product->stock = $data['stock'];
            $product->is_active = $data['status'];
            $product->save();
            return $product;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function findById(int $id): ?Product
    {
        try {
            $product = Product::findOrFail($id);
            return $product;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function totalPrice(array $ids): ?float
    {
        try {
            $total = Product::find($ids)->sum('price');
            return $total;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function totalPriceForShopping(array $products): ?float
    {
        try {
            $total = 0.00;
            foreach ($products as $item){
                $product = Product::find($item["id"]);
                $total += $product->price * $item["quantity"];
            }
            dd($total);
            return $total;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }
}