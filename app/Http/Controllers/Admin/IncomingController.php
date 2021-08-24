<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Incoming;
use Gate;
use Illuminate\Http\Response;
use Auth;

class IncomingController extends Controller
{
    public function index()
    {   
        abort_if(Gate::denies('incoming_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.dashboard.incoming.index');
    }

    public function create()
    {   
        abort_if(Gate::denies('incoming_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.dashboard.incoming.create');
    }

    public function show(Incoming $incoming)
    {   
        abort_if(Gate::denies('incoming_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if($incoming->department_id != Auth::user()->department_id, Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.dashboard.incoming.show',compact('incoming'));
    }

    public function edit(Incoming $incoming)
    {   
        abort_if(Gate::denies('incoming_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if($incoming->department_id != Auth::user()->department_id, Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.dashboard.incoming.edit',compact('incoming'));
    }
}
