<?php

namespace App\Http\Livewire\Incoming;

use Livewire\Component;
use App\Models\Incoming;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;

class Index extends Component
{   
    public $delete_id;

    public function render()
    {   
        $incomings = Incoming::list();
        return view('livewire.incoming.index',compact('incomings'));
    }

    public function delete()
    {   
        abort_if(Gate::denies('incoming_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        Incoming::findOrFail($this->delete_id)->delete();
        $this->reset('delete_id');

        return redirect('admin/incomings');
    }
}
