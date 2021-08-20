<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

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

    public function edit()
    {
        return view('admin.dashboard.category.create',compact('category'));
    }
    
}
