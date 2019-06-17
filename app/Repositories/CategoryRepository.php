<?php

namespace App\Repositories;

use App\Category;

class CategoryRepository
{
    public function getAllCategories()
    {
        return Category::all();
    }

}
