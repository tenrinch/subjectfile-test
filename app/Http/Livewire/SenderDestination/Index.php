<?php

namespace App\Http\Livewire\SenderDestination;

use Livewire\Component;
use App\Models\SenderDestination;

class Index extends Component
{   
    public $delete_id;

    public function render()
    {   
        $sender_destinations = SenderDestination::get();
        return view('livewire.sender-destination.index',compact('sender_destinations'));
    }

    public function delete()
    {   
        SenderDestination::findOrFail($this->delete_id)->delete();
        $this->reset('delete_id');
        return redirect('staff/sender-destinations');
    }

}
