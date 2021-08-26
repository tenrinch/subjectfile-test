<?php

namespace App\Http\Livewire;

use Hash;
use Livewire\Component;

class UpdatePasswordForm extends Component
{

    public $state = [];

    protected $validationAttributes = [
        'state.current_password' => 'current password',
        'state.password'         => 'new password',
    ];

    public function mount()
    {
        $this->resetState();
    }

    public function updatePassword()
    {

        $this->resetErrorBag();

        $this->validate();

        auth()->user()->update([
            'password' => Hash::make($this->state['password']),
        ]);

        $this->resetState();

        $this->emit('saved');
    }

    public function render()
    {
        return view('livewire.update-password-form');
    }

    protected function rules()
    {
        return [
            'state.current_password' => ['required', 'password'],
            'state.password'         => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    protected function resetState()
    {
        $this->state = [
            'current_password'      => '',
            'password'              => '',
            'password_confirmation' => '',
        ];
    }
}
