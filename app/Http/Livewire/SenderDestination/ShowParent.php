<?php

namespace App\Http\Livewire\SenderDestination;

use App\Models\SenderDestination;
use Livewire\Component;

class ShowParent extends Component
{
    public $sender_destinations = [];

    public $parent;

    public SenderDestination $sender_destinations_selected;

    public function mount($sender_destinations)
    {
        $this->sender_destinations = $sender_destinations->pluck('title', 'id')->toArray();
    }

    public function render()
    {
        return view('livewire.sender-destination.show-parent');
    }

    public function updatedParent($value)
    {
        if (!empty($value)) {
            $this->sender_destinations_selected = SenderDestination::find($value);
            $this->emitup('parent_selected', $value);
        } else {
            if (isset($this->sender_destinations_selected->parent)) {
                $this->emitUP('parent_selected', $this->sender_destinations_selected->parent->id);
            } else {
                $this->emitUp('parent_selected', null);
            }
            $this->sender_destinations_selected = new SenderDestination;
        }
    }
}
