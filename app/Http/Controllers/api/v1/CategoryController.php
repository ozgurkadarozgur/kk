<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryResource;
use App\Repositories\CategoryRepository;
use App\Repositories\Interfaces\ICategoryRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{

    private $categoryRepository;

    public function __construct(ICategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $top_categories = $this->categoryRepository->topCategories();
        return response()->json([
            'status' => 'success',
            'data' => CategoryResource::collection($top_categories),
        ], Response::HTTP_OK);
    }

    public function show($id)
    {
        $category = $this->categoryRepository->findById($id);
        if ($category) {
            return response()->json([
                'status' => 'success',
                'data' => new CategoryResource($category),
            ]);
        } else {
            return response()->json([
                'status' => 'not_found',
                'message' => 'Category not found.'
            ], Response::HTTP_NO_CONTENT);
        }
    }

}
