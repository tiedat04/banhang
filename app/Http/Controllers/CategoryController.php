<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function getCatelist()
    {
        $cates = Category::all();
        return view('admin/category.cate_list', compact('cates'));
    }
}