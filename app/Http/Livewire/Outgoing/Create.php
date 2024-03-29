<?php

namespace App\Http\Livewire\Outgoing;

use Livewire\Component;
use App\Models\Outgoing;
use App\Models\Media;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\SenderDestination;
use Illuminate\Support\Str;
use App\Traits\FileUpload;

class Create extends Component
{
    use FileUpload;

    public Outgoing $outgoing;

    public $files, $year, $cc, $parent;
    public $destination = [];
    public $listCategories = [];
    public $listDestinations = [];
    public $listCC = [];
    public $destinations = [];
    public SenderDestination $selected_destination;

    protected $listeners = ['parent_selected' => 'setCategory','sender_destination_selected'=>'setDestination'];

    public function mount(Outgoing $outgoing)
    {   
        $this->cc = false;
        $this->outgoing = $outgoing;
        $this->listCategories = Category::get()->whereNull('subcategory_of');
        $this->listDestinations = SenderDestination::get()
        ->where('fixed',1)
        ->whereNull('subsenderdestination_of')
        ->pluck('title','id')
        ->toArray();
        
        $this->year = date('Y'); //Gets current year
        $this->outgoing->dispatched_no = Outgoing::select('dispatched_no')
            ->where('year',$this->year)->max('dispatched_no') + 1;
        $this->destination['fixed'] = null;
    }

    public function render()
    {   
        return view('livewire.outgoing.create');
    }
    
    public function updatedYear($value)
    {
        $this->outgoing->dispatched_no = Outgoing::select('dispatched_no')
            ->where('year',$this->year)->max('dispatched_no') + 1;
    }

    public function setDestination($value)
    {
        $this->outgoing->destination_id = $value;
    }
    
    public function setCategory($category)
    {
        $this->outgoing->category_id = $category;
    }

    public function updatedParent($value)
    {
        if(!empty($value))
        {
            $this->selected_destination = SenderDestination::find($value);
            $this->outgoing->destination_id = $value;
        }
    }

    public function submit()
    {   
        $this->outgoing->year = $this->year;
        $this->validate();
        if($this->parent === '0')
        {
            $destination = SenderDestination::create($this->destination);
            $this->outgoing->destination_id = $destination->id; 
        }
        $this->outgoing->save();

        if(!empty($this->destinations))
        {
            $this->destinations = Arr::where($this->destinations, function ($value, $key) {
                if($value != $this->outgoing->destination_id){
                    return $value;
                }
            });
            $this->outgoing->destinations()->sync($this->destinations);
        }
        
        //If file is uploaded
        if($this->files)
        {      
            $this->uploads($this->files,$this->outgoing,'outgoing');
        }

        session()->flash('success', 'Outgoing file added!');
        return redirect(url('staff/outgoings'));
    }

    protected function rules(): array
    {
        return [
            'outgoing.dispatched_no' => [
                'integer',
            ],
            'outgoing.category_id' => [
                'integer',
            ],
            'outgoing.mode' => [
                'string',
            ],
            'outgoing.urgency' => [
                'string',
            ],
            'outgoing.status' => [
                'string',
            ],
            'outgoing.file_no' => [
                'string',
                'required',
            ],
            'outgoing.year' => [
                'integer',
            ],
            'outgoing.dispatched_date' => [
                'date',
                'required',
            ],
            'outgoing.destination_id' => [
                'integer',
            ],
            'outgoing.subject' => [
                'string',
            ],
            'outgoing.remarks' => [
                'string',
            ],
            'outgoing.language' => [
                'string',
            ],
            'outgoing.department_id' => [
                'integer',
            ],
        ];
    }
}
