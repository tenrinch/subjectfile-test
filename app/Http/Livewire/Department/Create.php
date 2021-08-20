<?php

namespace App\Http\Livewire\Department;

use Livewire\Component;
use App\Models\Department;

class Create extends Component
{
    public Department $department;

    public function mount(department $department)
    {
        $this->department = $department;
    }

    public function render()
    {
        return view('livewire.department.create');
    }

    public function submit()
    {   
        $this->validate();
        $this->department->save();

        session()->flash('success', 'Department added!');
        return redirect(url('admin/departments'));
    }

    protected function rules(): array
    {
        return [
            'department.title' => [
                'string',
                'required',
            ]
        ];
    }
}
