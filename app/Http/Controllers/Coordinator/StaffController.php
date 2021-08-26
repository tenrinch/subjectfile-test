<?php

namespace App\Http\Controllers\Coordinator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;
use App\Models\User;
use Auth;

class StaffController extends Controller
{
    public function index()
    {   
        abort_if(Gate::denies('staff_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('coordinator.staff.index');
    }

    public function create()
    {   
        abort_if(Gate::denies('staff_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('coordinator.staff.create');
    }

    public function edit(User $staff)
    {   
        abort_if(Gate::denies('staff_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if($staff->department_id != Auth::user()->department_id, Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('coordinator.staff.edit',compact('staff'));
    }
}
