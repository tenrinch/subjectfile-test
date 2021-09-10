<?php

namespace App\Http\Livewire\File;

use Livewire\Component;
use App\Models\File;
use App\Http\Livewire\WithSorting;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;
use Livewire\WithPagination;

class Index extends Component
{   
    use WithPagination;
    use WithSorting;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $paginationOptions;

    protected $queryString = [
        'search' => [
            'except' => '',
        ],
        'sortBy' => [
            'except' => 'register_no',
        ],
        'sortDirection' => [
            'except' => 'desc',
        ],
    ];

    public function mount()
    {
        $this->sortBy            = 'register_no';
        $this->sortDirection     = 'desc';
        $this->perPage           = 20;
        $this->paginationOptions = config('project.pagination.options');
        $this->orderable         = (new File())->orderable;
    }


    public function render()
    {   
        $query = File::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $files = $query->paginate($this->perPage);
        return view('livewire.file.index',compact('files','query'));
    }
}
