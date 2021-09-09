<?php

namespace App\Http\Livewire\Staff;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\User;

class UpdateProfile extends Component
{
    use AuthorizesRequests;

    public User $staff;
    public $selectSection, $section, $department;
    public $listSections = [];

    protected $validationAttributes = [
        'staff.name'  => 'name',
        'staff.email' => 'email',
    ];

    public function mount(User $staff)
    {   
        $this->department = auth()->user()->department;
        $this->section = null;
        $this->listSections = $this->department
            ->sections()
            ->pluck('title','id')
            ->toArray();
        $this->staff = $staff->withoutRelations();
    }

    public function updatedSelectSection($value)
    {
        if(!empty($value) AND $value!='0')
        {
            $this->section = $value;
        }
    }

    public function updateProfile()
    {
        $this->authorize('staff_edit');

        $this->resetErrorBag();

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

        $this->validate();

        $this->staff->update();

        session()->flash('success', 'Staff profile updated!');
        return redirect()->route('coordinator.staff.index');
    }

    public function render()
    {
        return view('livewire.staff.update-profile');
    }

    protected function rules()
    {
        return [
            'staff.name'  => ['required', 'string', 'max:255'],
            'staff.email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email,'.$this->staff->id,
            ],
        ];
    }
}
