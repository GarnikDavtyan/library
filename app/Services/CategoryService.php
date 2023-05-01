<?php

namespace App\Services;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;

class CategoryService {
    public function list(): Collection
    {
        $categories = Category::all();

        return $categories;
    }

    public function store(StoreCategoryRequest $request): Category
    {
        $category = new Category();

        $category->title = $request->title;
        
        // generate a unique slug
        $slug = Str::slug($request->title);
        while(Category::where('slug', $slug)->first()) {
            $slug .= '-'. strtolower(Str::random(3));
        }
        $category->slug = $slug;

        $category->save();

        return $category;
    }
    
    public function update(UpdateCategoryRequest $request, Category $category): Category
    {
        $category->title = $request->title;

        $slug = Str::slug($request->title);

        // generate a unique slug
        while(Category::where('id', '<>', $category->id)->where('slug', $slug)->first()) {
            $slug .= '-'. strtolower(Str::random(3));
        }
        $category->slug = $slug;

        $category->save();
            
        return $category;
    }

    public function delete(Category $category): void
    {
        try {
            $category->delete();
        }
        catch(QueryException $e) {
            if ($e->errorInfo[1] === 1451) {
                throw $e;
            }
        }
    }
}