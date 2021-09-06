<?php

namespace App\Http\Livewire\Staff;

use Livewire\Component;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{   
    public User $staff;

    public string $password = '';

    public function mount(User $staff)
    {
        $this->staff = $staff;
    }

    public function render()
    {
        return view('livewire.staff.create');
    }

    public function submit()
    {
        $this->validate();
        $this->staff->password = $this->password;
        $this->staff->department_id = Auth::user()->department_id;
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
