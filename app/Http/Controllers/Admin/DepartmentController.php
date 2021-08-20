<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use Gate;
use Illuminate\Http\Response;

class DepartmentController extends Controller
{
    public function index()
    {   
        abort_if(Gate::denies('department_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.dashboard.department.index');
    }

    public function create()
    {   
        abort_if(Gate::denies('department_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.dashboard.department.create');
    }

    public function edit(Department $department)
    {   
        abort_if(Gate::denies('department_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.dashboard.department.edit',compact('department'));
    }
}
