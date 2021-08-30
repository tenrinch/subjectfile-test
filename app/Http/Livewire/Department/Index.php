<?php

namespace App\Http\Livewire\Department;

use Livewire\Component;
use App\Models\Department;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;

class Index extends Component
{
    public $delete_id;

    public function render()
    {   
        $departments = Department::all();
        return view('livewire.department.index',compact('departments'));
    }

    public function delete()
    {   
        abort_if(Gate::denies('department_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        Department::findOrFail($this->delete_id)->delete();
        $this->reset('delete_id');

        session()->flash('delete', 'Department deleted!');
        return redirect('admin/departments');
    }
}
