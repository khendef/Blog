<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Requests\v1\Category\StoreCategoryRequest;
use App\Http\Requests\v1\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function index()
    {
        $categories = Category::all();
        return self::success($categories);
        
    }

   
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->validated());
        return self::success($category,'created successfully',201);
        
    }

    
    public function show(Category $category)
    {
        return self::success($category);
        
    }

   
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return self::success($category);
        
    }

    
    public function destroy(Category $category)
    {
        $category->delete();
        return self::success(null, 'deleted successfully',204);
       
    }
}
