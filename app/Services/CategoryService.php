<?php

namespace App\Services;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;

class CategoryService {
    public function list(): Collection
    {
        $categories = Category::all();

        return $categories;
    }

    public function store(StoreCategoryRequest $request): Category
    {
        $category = Category::create([
            'title' => $request->title
        ]);

        return $category;
    }
    
    public function update(UpdateCategoryRequest $request, Category $category): Category
    {
        $category->update([
            'title' => $request->title
        ]);
            
        return $category;
    }

    public function delete(Category $category): void
    {
        try {
            $category->delete();
        }
        catch(QueryException $e) {
            // foreign key constraint violation
            if ($e->errorInfo[1] === 1451) {
                throw $e;
            }
        }
    }
}