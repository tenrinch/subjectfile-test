<?php

namespace App\Http\Livewire\Incoming;

use Livewire\Component;
use App\Models\Incoming;
use App\Http\Livewire\WithSorting;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;
use Livewire\WithPagination;
use App\Models\SenderDestination;

class Index extends Component
{   
    use WithPagination;
    use WithSorting;

    public $delete_id;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public $lists = [];

    public $sender, $file, $year;

    public array $paginationOptions;

    protected $queryString = [
        'search' => [
            'except' => '',
        ],
        'sortBy' => [
            'except' => 'incoming_no',
        ],
        'sortDirection' => [
            'except' => 'desc',
        ],
    ];

    public function getSelectedCountProperty()
    {
        return count($this->selected);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function resetSelected()
    {
        $this->selected = [];
    }

    public function mount()
    {
        $this->sortBy            = 'incoming_no';
        $this->sortDirection     = 'desc';
        $this->perPage           = 10;
        $this->paginationOptions = config('project.pagination.options');
        $this->orderable         = (new Incoming())->orderable;
        $this->lists['senderdestinations']  = SenderDestination::pluck('title','id')->toArray();
        $this->lists['files']    = Incoming::pluck('file_no')->toArray();
    }


    public function render()
    {   
        $query = Incoming::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $incomings = $query->when(!empty($this->sender), function ($q){
                $q->where('sender_id', $this->sender);
            })
            ->when(!empty($this->file), function ($q){
                $q->where('file_no', $this->file);
            })
            ->when(!empty($this->year), function ($q){
                $q->where('year', $this->year);
            })
            ->paginate($this->perPage);
        
        return view('livewire.incoming.index',compact('query', 'incomings'));
    }

    //Delete logic
    public function delete()
    {   
        abort_if(Gate::denies('incoming_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        Incoming::findOrFail($this->delete_id)->delete();
        $this->reset('delete_id');

        session()->flash('delete', 'Incoming file deleted!');
        return redirect('staff/incomings');
    }
}
