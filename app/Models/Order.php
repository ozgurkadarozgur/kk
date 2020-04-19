<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App\Models
 * @property $id
 * @property $user_id
 * @property $total
 * @property $status
 * @property $address
 */
class Order extends Model
{
    protected $table = 'orders';

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

}
