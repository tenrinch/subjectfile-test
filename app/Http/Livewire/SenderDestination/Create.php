<?php

namespace App\Http\Livewire\SenderDestination;

use Livewire\Component;
use App\Models\SenderDestination;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public SenderDestination $sender_destination;

    public $listSenderDestinations = [];

    protected $listeners = ['sender_destination_selected' => 'setParent'];

    public function setParent($value)
    {
        $this->sender_destination->subsenderdestination_of = $value;
    }

    public function mount(SenderDestination $sender_destination)
    {
        $this->sender_destination = $sender_destination;
        $this->listSenderDestinations = SenderDestination::get()->whereNull('subsenderdestination_of');
    }

    public function render()
    {
        return view('livewire.sender-destination.create');
    }

    public function submit()
    {
        $this->validate();
        $this->sender_destination->fixed = 1;
        $this->sender_destination->save();

        session()->flash('success', 'Sender Destination added!');
        return redirect()->route('staff.sender-destinations.index');
    }

    protected function rules(): array
    {
        return [
            'sender_destination.title' => [
                'string',
                'required',
            ],
            'sender_destination.subsenderdestination_of' => [
                'integer'
            ]
        ];
    }
}
