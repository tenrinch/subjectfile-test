<?php

namespace App\Http\Controllers\Staff;

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
        return view('staff.incoming.index');
    }

    public function create()
    {   
        abort_if(Gate::denies('incoming_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('staff.incoming.create');
    }

    public function show($id)
    {   
        abort_if(Gate::denies('incoming_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $incoming = Incoming::get()->find($id);
        abort_if(!isset($incoming), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('staff.incoming.show',compact('incoming'));
    }

    public function edit($id)
    {   
        abort_if(Gate::denies('incoming_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $incoming = Incoming::get()->find($id);
        abort_if(!isset($incoming), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        return view('staff.incoming.edit',compact('incoming'));
    }
}
