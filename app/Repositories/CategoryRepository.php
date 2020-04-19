<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 19.04.2020
 * Time: 16:54
 */

namespace App\Repositories;


use App\Models\Category;
use App\Repositories\Interfaces\ICategoryRepository;
use Illuminate\Support\Collection;

class CategoryRepository implements ICategoryRepository
{

    public function all(): Collection
    {
        try {
            $categories = Category::all();
            return $categories;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function create($data): ?Category
    {
        try {
            $category = new Category();
            $category->parent_id = $data['parent_id'] ? $data['parent_id'] : 0;
            $category->title = $data['title'];
            $category->is_active = $data['status'];
            $category->save();
            return $category;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function findById(int $id): ?Category
    {
        try {
            $category = Category::findOrFail($id);
            return $category;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function topCategories(): Collection
    {
        try {
            $top_categories = Category::where('parent_id', 0)->get();
            return $top_categories;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }
}