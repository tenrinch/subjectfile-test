<?php

namespace App\Http\Livewire\Incoming;

use Livewire\Component;
use App\Models\Incoming;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;
use Livewire\WithPagination;

class Index extends Component
{   
    use WithPagination;
    public $delete_id;

    public function render()
    {   
        $incomings = Incoming::orderBy('incoming_no')->paginate(20);
        return view('livewire.incoming.index',compact('incomings'));
    }

    public function delete()
    {   
        abort_if(Gate::denies('incoming_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        Incoming::findOrFail($this->delete_id)->delete();
        $this->reset('delete_id');

        session()->flash('delete', 'Incoming file deleted!');
        return redirect('staff/incomings');
    }
}
