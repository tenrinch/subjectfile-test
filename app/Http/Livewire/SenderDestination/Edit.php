<?php

namespace App\Http\Livewire\SenderDestination;

use Livewire\Component;
use App\Models\SenderDestination;

class Edit extends Component
{   
    public SenderDestination $sender_destination;
    public $listSenderDestinations;
    protected $listeners = ['sender_destination_selected' => 'setParent'];

    public function mount(SenderDestination $sender_destination)
    {
        $this->sender_destination = $sender_destination;
        $this->listSenderDestinations = SenderDestination::get()
        ->whereNull('subsenderdestination_of')
        ->where('fixed','1');
    }

    public function setParent($value)
    {   
        $this->sender_destination->subsenderdestination_of = $value;
    }

    public function update()
    {
        $this->validate();
        $this->sender_destination->update();

        session()->flash('success', 'Sender/Destination updated!');
        return redirect()->route('staff.sender-destinations.index');
    }

    public function render()
    {
        return view('livewire.sender-destination.edit');
    }

    protected function rules(): array
    {
        return [
            'sender_destination.title' => [
                'string',
                'required',
            ],
            'sender_destination.fixed' => [
                'integer',
                'required',
            ],
            'sender_destination.subsenderdestination_of' => [
                'integer',
            ]
        ];
    }
}
