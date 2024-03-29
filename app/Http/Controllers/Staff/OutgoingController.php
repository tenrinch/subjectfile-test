<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Outgoing;
use Gate;
use Illuminate\Http\Response;
use Auth; 
class OutgoingController extends Controller
{
    public function index()
    {   
        abort_if(Gate::denies('outgoing_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('staff.outgoing.index');
    }

    public function create()
    {   
        abort_if(Gate::denies('outgoing_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('staff.outgoing.create');
    }

    public function show($id)
    {   
        abort_if(Gate::denies('outgoing_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $outgoing = Outgoing::get()->find($id);
        abort_if(!isset($outgoing), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('staff.outgoing.show',compact('outgoing'));
    }
    
    public function edit($id)
    {   
        abort_if(Gate::denies('outgoing_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $outgoing = Outgoing::get()->find($id);
        abort_if(!isset($outgoing), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('staff.outgoing.edit',compact('outgoing'));
    }
}
