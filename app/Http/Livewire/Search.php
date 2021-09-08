<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Models\Incoming;
use App\Models\Outgoing;
use App\Models\Category;
use App\Http\Livewire\WithSorting;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;
use Livewire\WithPagination;
use App\Models\SenderDestination;

class Search extends Component
{   
    use WithPagination;
    use WithSorting;

    public $type, $subject, $search_flag;

    public $delete_id;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public $filter =[];

    public $date = [];

    public $letter = [];

    public $lists = [];

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

    public function mount()
    {
        $this->search_flag                  = false;
        $this->type                         = 'incomings';
        $this->sortBy                       = 'incoming_no';
        $this->sortDirection                = 'desc';
        $this->perPage                      = 20;
        $this->orderable                    = (new Incoming())->orderable;
        $this->lists['senderdestinations']  = SenderDestination::pluck('title','id')->toArray();
        $this->lists['categories']          = Category::pluck('title','id')->toArray();
    }

    public function render()
    {   
        if($this->search_flag)
        {
             if($this->type == 'incomings')  
            {
                $query = Incoming::advancedFilter([
                    's'               => $this->search ?: null,
                    'order_column'    => $this->sortBy,
                    'order_direction' => $this->sortDirection,
                ]);
            }     
            else
            {
                $query = Outgoing::advancedFilter([
                    's'               => $this->search ?: null,
                    'order_column'    => $this->sortBy,
                    'order_direction' => $this->sortDirection,
                ]);
            }
            
            foreach($this->filter as $key => $value)
            {   
                if(!empty($value))
                {   
                    if($key == 'file_no')
                    {
                        $query =  $query->where($key,'LIKE','%'.$value.'%');
                    }
                    else{
                        $query =  $query->where($key,$value);
                    }
                }
            }

            foreach($this->date as $key => $value)
            {   
                $field = $this->type == 'incomings' ? 'received_date' : 'dispatched_date';
                if($key == 'date_from')
                {
                    $query =  $query->where( $field,'>=',$value);
                }
                elseif($key=='date_to')
                {
                    $query =  $query->where($field,'<=',$value);
                }
            }

            foreach($this->letter as $key => $value)
            {   
                if($key == 'letter_no')
                {
                    $query =  $query->where($key,'%'.$value.'%');
                }
                elseif($key == 'letter_from')
                {
                    $query =  $query->where('letter_date','>=',$value);
                }
                elseif($key == 'letter_to')
                {
                    $query =  $query->where('letter_date','<=',$value);
                }   
            }
            $records = $query->when(!empty($this->subject), function ($q){
                    $q->where($this->type == 'incomings' ? 'incoming_no' : 'dispatched_no', $this->subject)
                    ->orWhere('subject','LIKE','%'.$this->subject.'%')
                    ->orWhere('remarks','LIKE','%'.$this->subject.'%');
                })
                ->paginate($this->perPage);
            return view('livewire.search',compact('records','query'));
        }
        else
        {
            return view('livewire.search');
        }
       
    }

    public function updatedType($value)
    {
        $this->type = $value;
        $this->resetPage();
        $this->sortBy = $value == 'incomings' ? 'incoming_no' : 'dispatched_no';
        $this->orderable = $value == 'incomings' ? (new Incoming())->orderable : (new Outgoing())->orderable;
        $this->search_flag = false;
    }

    public function resetField()
    {
        $this->reset('filter','letter','date','subject','search_flag');
    }

}
