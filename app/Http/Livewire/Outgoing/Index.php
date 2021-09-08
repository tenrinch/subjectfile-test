<?php

namespace App\Http\Livewire\Outgoing;

use Livewire\Component;
use App\Models\Outgoing;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;
use Livewire\WithPagination;
use App\Http\Livewire\WithSorting;
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
            'except' => 'dispatched_no',
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
        $this->sortBy            = 'dispatched_no';
        $this->sortDirection     = 'desc';
        $this->perPage           = 10;
        $this->paginationOptions = config('project.pagination.options');
        $this->orderable         = (new Outgoing())->orderable;
        $this->lists['senderdestinations']  = SenderDestination::pluck('title','id')->toArray();
        $this->lists['files']    = Outgoing::pluck('file_no')->toArray();
    }


    public function render()
    {   
        $query = Outgoing::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $outgoings = $query->when(!empty($this->sender), function ($q){
                $q->where('destination_id', $this->sender);
            })
            ->when(!empty($this->file), function ($q){
                $q->where('file_no', $this->file);
            })
            ->when(!empty($this->year), function ($q){
                $q->where('year', $this->year);
            })
            ->paginate($this->perPage);
        return view('livewire.outgoing.index',compact('query','outgoings'));
    }

    public function delete()
    {   
        abort_if(Gate::denies('outgoing_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        Outgoing::findOrFail($this->delete_id)->delete();
        $this->reset('delete_id');

        session()->flash('delete', 'Outgoing file deleted!');
        return redirect('staff/outgoings');
    }
}
