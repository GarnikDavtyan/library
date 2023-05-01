<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Database\QueryException;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $service)
    {
        $this->categoryService = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->categoryService->list();

        return $this->successResponse($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = $this->categoryService->store($request);

        return $this->successResponse($category, 'Category created successfully', 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category = $this->categoryService->update($request, $category);

        return $this->successResponse($category, 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $this->categoryService->delete($category);
        }
        catch(QueryException $e) {
            return $this->errorResponse('Can\'t delete. Category is in use', 422);
        }

        return $this->successResponse(null, 'Category deleted successfully');
    }
}
