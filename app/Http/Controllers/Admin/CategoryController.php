<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function index()
    {   
        $categories = Category::list()->whereNull('subcategory_of');
        return view('admin.dashboard.category.index',compact('categories'));
    }

    public function create()
    {
        return view('admin.dashboard.category.create');
    }

    public function edit(Category $category)
    {   
        abort_if($category->department_id != Auth::user()->department_id, Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.dashboard.category.edit',compact('category'));
    }
    
}
