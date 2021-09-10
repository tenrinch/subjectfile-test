<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index()
    {   
        //abort_if(Gate::denies('file_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('staff.file.index');
    }

    public function create()
    {   
        //abort_if(Gate::denies('file_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('staff.file.create');
    }

    /*
    public function show($id)
    {   
        abort_if(Gate::denies('file_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $file = file::get()->find($id);
        abort_if(!isset($file), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('staff.file.show',compact('file'));
    }

    public function edit($id)
    {   
        abort_if(Gate::denies('file_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $file = file::get()->find($id);
        abort_if(!isset($file), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        return view('staff.file.edit',compact('file'));
    }*/
}
