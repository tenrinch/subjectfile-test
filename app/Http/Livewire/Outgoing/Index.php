<?php

namespace App\Http\Livewire\Outgoing;

use Livewire\Component;
use App\Models\Outgoing;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;

class Index extends Component
{
    public $delete_id;

    public function render()
    {   
        $outgoings = Outgoing::list();
        return view('livewire.outgoing.index',compact('outgoings'));
    }

    public function delete()
    {   
        abort_if(Gate::denies('outgoing_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        Outgoing::findOrFail($this->delete_id)->delete();
        $this->reset('delete_id');

        return redirect('admin/outgoings');
    }
}
