<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package App\Models
 * @property $id
 * @property $parent_id
 * @property $image_url
 * @property $title
 * @property $is_active
 */
class Category extends Model
{
    protected $table = 'categories';

    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
