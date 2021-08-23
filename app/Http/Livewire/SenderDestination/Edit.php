<?php

namespace App\Http\Livewire\SenderDestination;

use Livewire\Component;
use App\Models\SenderDestination;

class Edit extends Component
{   
    public SenderDestination $sender_destination;

    public function mount(SenderDestination $sender_destination)
    {
        $this->sender_destination = $sender_destination;
    }

    public function update()
    {
        $this->validate();
        $this->sender_destination->update();

        return redirect()->route('admin.sender-destinations.index');
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
            ]
        ];
    }
}
