<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderItem
 * @package App\Models
 * @property $order_id
 * @property $product_id
 * @property $quantity
 * @property $price
 */
class OrderItem extends Model
{
    protected $table = 'order_items';

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

}
