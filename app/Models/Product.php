<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App\Models
 * @property $id
 * @property $category_id
 * @property $title
 * @property $description
 * @property $image_url
 * @property $price
 * @property $stock
 * @property $is_active
 */
class Product extends Model
{
    protected $table = 'products';

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}
