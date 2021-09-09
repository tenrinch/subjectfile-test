<?php

namespace App\Http\Livewire\Staff;

use Livewire\Component;
use App\Models\Role;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Create extends Component
{   
    public User $staff;

    public $selectSection, $section, $department;
    public $listSections = [];

    public string $password = '';

    public function mount(User $staff)
    {   
        
        $this->department = auth()->user()->department;
        $this->staff = $staff;
        $this->section = null;
        $this->listSections = $this->department
            ->sections()
            ->pluck('title','id')
            ->toArray();
    }

    public function render()
    {
        return view('livewire.staff.create');
    }

    public function updatedSelectSection($value)
    {
        if(!empty($value) AND $value != '0')
        {
            $this->section = $value;
        }
        else
        {
            $this->reset('section');
        }
    }

    public function submit()
    {   
        if($this->section)
        {
            if($this->selectSection == 0)
            {
                $this->staff->department_id = $this->department
                ->sections()
                ->create(['title'=>$this->section,'slug'=>Str::slug($this->section, '-')])->id;
            }
            else
            { 
                $this->staff->department_id = $this->section;
            }
        }
        else
        {
            $this->staff->department_id = Auth::user()->department_id;
        }

        $this->validate();
        $this->staff->password = $this->password;
        $this->staff->save();

        $role = Role::select('id')->where('title','Staff')->first();
        $this->staff->roles()->sync($role->id);

        session()->flash('success', 'Staff added!');
        return redirect()->route('coordinator.staff.index');
    }

    protected function rules(): array
    {
        return [
            'staff.name' => [
                'string',
                'required',
            ],
            'staff.email' => [
                'email:rfc',
                'required',
                'unique:users,email',
            ],
            'password' => [
                'string',
                'required',
            ],
        ];
    }
}
