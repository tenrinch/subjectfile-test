<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SenderDestination;
use Auth;
use Illuminate\Http\Response;

class SenderDestinationController extends Controller
{   

    public function index()
    {   
        return view('staff.sender-destination.index');
    }

    public function create()
    {   
        return view('staff.sender-destination.create');
    }

    public function edit(SenderDestination $sender_destination)
    {   
        abort_if($sender_destination->department_id != Auth::user()->department_id, Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('staff.sender-destination.edit',compact('sender_destination'));
    }
}
