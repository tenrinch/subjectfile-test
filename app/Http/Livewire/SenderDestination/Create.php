<?php

namespace App\Http\Livewire\SenderDestination;

use Livewire\Component;
use App\Models\SenderDestination;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{   
    public SenderDestination $sender_destination;

    public function mount(SenderDestination $sender_destination)
    {
        $this->sender_destination = $sender_destination;
    }

    public function render()
    {
        return view('livewire.sender-destination.create');
    }

    public function submit()
    {
        $this->validate();
        $this->sender_destination->fixed = 1;
        $this->sender_destination->department_id = Auth::user()->department_id;
        $this->sender_destination->save();

        return redirect()->route('staff.sender-destinations.index');
    }

    protected function rules(): array
    {
        return [
            'sender_destination.title' => [
                'string',
                'required',
            ]
        ];
    }
}
