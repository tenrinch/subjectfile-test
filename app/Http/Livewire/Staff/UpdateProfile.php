<?php

namespace App\Http\Livewire\Staff;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\User;

class UpdateProfile extends Component
{
    use AuthorizesRequests;

    public User $staff;

    protected $validationAttributes = [
        'staff.name'  => 'name',
        'staff.email' => 'email',
    ];

    public function mount(User $staff)
    {   
        $this->staff = $staff->withoutRelations();
    }

    public function updateProfile()
    {
        $this->authorize('staff_edit');

        $this->resetErrorBag();

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
