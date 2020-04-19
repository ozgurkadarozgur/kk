<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 19.04.2020
 * Time: 16:52
 */

namespace App\Repositories\Interfaces;


use App\Models\Category;
use Illuminate\Support\Collection;

interface ICategoryRepository
{
    public function all() : Collection;

    public function topCategories() : Collection;

    public function create($data) : ?Category;

    public function findById(int $id) : ?Category;
}