<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Repositories\Category\CategoryRepository;
use App\Http\Requests\Category\StoreCategoryRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryService
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function createCategory(StoreCategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->name;

        // membuat slug otomatis dari nama kategori dan menambahkan id user
        $category->slug = Str::slug($request->name . '-' . Auth::user()->id);

        $category->user_id = Auth::user()->id;
        return $this->categoryRepository->insert($category);
    }
}

?>
