<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Services\Category\CategoryService;
use App\Http\Controllers\API\BaseController as BaseController;
use Exception;

class APICategoryController extends BaseController
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function store(StoreCategoryRequest $request)
    {
        try {
            $request->validated();
            $category = $this->categoryService->createCategory($request);
            return $this->sendResponse('Successfully Created Category', 200, $category);
        } catch (Exception $err) {
            return $this->sendError('Fail', 422, $err->getMessage());
        }
    }
}
