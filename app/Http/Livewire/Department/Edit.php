<?php

namespace App\Http\Livewire\Department;

use Livewire\Component;
use App\Models\Department;
class Edit extends Component
{
    public Department $department;

    public function mount(Department $department)
    {
        $this->department = $department;
    }

    public function render()
    {
        return view('livewire.department.edit');
    }

    public function update()
    {   
        $this->validate();
        $this->department->update();

        session()->flash('success', 'Department updated!');
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
