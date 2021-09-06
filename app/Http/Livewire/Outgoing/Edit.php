<?php

namespace App\Http\Livewire\Outgoing;

use Livewire\Component;
use App\Models\Outgoing;
use App\Models\Media;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\SenderDestination;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class Edit extends Component
{
    use WithFileUploads;

    public Outgoing $outgoing;

    public $files, $year, $cc, $parent, $dispatched_no;
    public $destination = [];
    public $listCategories = [];
    public $listDestinations = [];
    public $listCC = [];
    public $destinations = [];
    public SenderDestination $selected_destination;

    protected $listeners = ['parent_selected' => 'setCategory','sender_destination_selected'=>'setDestination'];

    public function mount(Outgoing $outgoing)
    {   
        $this->outgoing = $outgoing;
        $this->listCategories = Category::get()->whereNull('subcategory_of');
        $this->listDestinations = SenderDestination::get()
        ->where('fixed',1)
        ->whereNull('subsenderdestination_of')
        ->pluck('title','id')
        ->toArray();
        $this->year = $this->outgoing->year;
        $this->dispatched_no = $this->outgoing->dispatched_no;
        $this->destinations = $this->outgoing->destinations()->pluck('id')->toArray();
        $this->parent = $this->outgoing->destination_id;
        if(count($this->outgoing->destinations))
        {
            $this->cc = true;
        }
    }

    public function render()
    {   
        return view('livewire.outgoing.edit');
    }

    public function updatedYear($value)
    {
        if($value == $this->outgoing->year)
        {
            $this->dispatched_no = $this->outgoing->dispatched_no;
        }
        else{
            $this->dispatched_no = Outgoing::select('dispatched_no')
            ->where('year',$this->year)->max('dispatched_no') + 1;
        }
    }

    public function updatedParent($value)
    {
        if(!empty($value))
        {
            $this->selected_destination = SenderDestination::find($value);
            $this->outgoing->destination_id = $value;
        }
    }

    public function setCategory($category)
    {
        $this->outgoing->category_id = $category;
    }

    public function setDestination($value)
    {
        $this->outgoing->destination_id = $value;
    }

    public function update()
    {   
        $this->validate(); 
        if($this->outgoing->year != $this->year || $this->outgoing->dispatched_no != $this->dispatched_no)
        {
            $this->outgoing->year = $this->year;
            $this->outgoing->dispatched_no = $this->dispatched_no;
        }

        if(!empty($this->destinations))
        {
            $this->destinations = Arr::where($this->destinations, function ($value, $key) {
                if($value != $this->outgoing->destination_id){
                    return $value;
                }
            });
            $this->outgoing->destinations()->sync($this->destinations);
        }

        $this->outgoing->update();
       
        //If file is uploaded
        if($this->files)
        {      
            foreach($this->files as $file) 
            {   
                $file_name = $file->getClientOriginalName();
                $media = [];
                $media['type']      = 'outgoing';
                $media['name']      = $file_name;
                $media['path']      = $file->storeAs(Auth::user()->department->slug.'/outgoings',Str::slug($file_name, '-'));

                $this->outgoing->medias()->create($media);
            }
        }

        session()->flash('success', 'Outgoing file updated!');
        return redirect(url('staff/outgoings'));
    }

    public function removeFile($media_id)
    {
        $this->outgoing->files->where('id',$media_id)->delete(); 
        session()->flash('delete', 'File uploaded removed!');
        return redirect(url('staff/outgoings/'.$this->outgoing->id.'/edit'));
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
            'outgoing.status' => [
                'string',
            ],
            'outgoing.file_no' => [
                'string',
                'required',
            ],
            'outgoing.year' => [
                'integer',
                'required',
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
            'outgoing.mode' => [
                'string',
            ],
            'outgoing.urgency' => [
                'string',
            ],
            'outgoing.remarks' => [
                'string',
            ]

        ];
    }
}
