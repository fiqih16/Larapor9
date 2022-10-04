<?php

namespace App\Repositories\Category;

use App\Models\Category;

class CategoryRepository
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function insert(Category $category)
    {
        $category->save();
        return $category;
    }

    public function update(Category $category)
    {
        $category->update();
        return $category;
    }

    public function FindByUserId($id)
    {
        return $this->category->where('user_id', $id)->get();
    }

    public function FindById($id)
    {
        return $this->category->where('id', $id)->first();
    }
}

?>