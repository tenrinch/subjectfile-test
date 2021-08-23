<?php

namespace App\Http\Livewire\Staff;

use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;
use App\Models\User;

class Index extends Component
{
    public $delete_id;

    public function render()
    {   
        $staffs = User::listStaff();
        return view('livewire.staff.index',compact('staffs'));
    }

    public function delete()
    {   
        abort_if(Gate::denies('staff_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        User::findOrFail($this->delete_id)->delete();
        $this->reset('delete_id');

        return redirect('admin/staff');
    }
}
