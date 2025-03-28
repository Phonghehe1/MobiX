<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($id)
    {
        $category = Category::findOrFail($id);
        $products = $category->products; // Lấy sản phẩm thuộc danh mục này
        return view('category.show', compact('category', 'products'));
    }
}
