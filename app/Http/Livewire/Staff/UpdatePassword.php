<?php

namespace App\Http\Livewire\Staff;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\User;
use Hash;

class UpdatePassword extends Component
{
    use AuthorizesRequests;

    public $state = [];

    public $staff_id;

    protected $validationAttributes = [
        'state.password'         => 'new password',
    ];

    public function mount(User $staff)
    {
        $this->staff_id = $staff->id;
        $this->resetState();
    }

    public function updatePassword()
    {
        $this->authorize('staff_edit');

        $this->resetErrorBag();

        $this->validate();

        User::find($this->staff_id)->update([
            'password' => Hash::make($this->state['password']),
        ]);

        $this->resetState();

        session()->flash('success', 'Staff password updated!');
        return redirect()->route('coordinator.staff.index');
    }

    public function render()
    {
        return view('livewire.staff.update-password');
    }

    protected function rules()
    {
        return [
            'state.password'         => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    protected function resetState()
    {
        $this->state = [
            'password'              => '',
            'password_confirmation' => '',
        ];
    }
}
