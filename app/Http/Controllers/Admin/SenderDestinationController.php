<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SenderDestination;

class SenderDestinationController extends Controller
{
    public function index()
    {   
        return view('admin.dashboard.sender-destination.index');
    }

    public function create()
    {   
        return view('admin.dashboard.sender-destination.create');
    }

    public function edit(SenderDestination $sender_destination)
    {   
        return view('admin.dashboard.sender-destination.edit',compact('sender_destination'));
    }
}
