<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Outgoing;
use Gate;
use Illuminate\Http\Response;

class OutgoingController extends Controller
{
    public function index()
    {   
        abort_if(Gate::denies('outgoing_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.dashboard.outgoing.index');
    }

    public function create()
    {   
        abort_if(Gate::denies('outgoing_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.dashboard.outgoing.create');
    }

    public function show(Outgoing $outgoing)
    {   
        abort_if(Gate::denies('outgoing_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if($outgoing->department_id != Auth::id(), 403);
        return view('admin.dashboard.outgoing.show',compact('outgoing'));
    }
    
    public function edit(Outgoing $outgoing)
    {   
        abort_if(Gate::denies('outgoing_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if($outgoing->department_id != Auth::id(), 403);
        return view('admin.dashboard.outgoing.edit',compact('outgoing'));
    }
}
