<?php

namespace App\Http\Livewire\Incoming;

use Livewire\Component;
use App\Models\Incoming;
use App\Models\Media;
use App\Models\User;
use App\Models\Category;
use App\Models\Department;
use App\Models\SenderDestination;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Create extends Component
{   
    use WithFileUploads;

    public Incoming $incoming;
    
    public $year,$parent;
    public $files;
    public $sender = [];
    public $listCategories = [];
    public $listSenders = [];
    public SenderDestination $selected_sender;

    protected $listeners = ['parent_selected' => 'setCategory','sender_destination_selected'=>'setSender'];

    public function mount(Incoming $incoming)
    {   
        $this->incoming = $incoming;
        $this->listCategories = Category::get()->whereNull('subcategory_of');
        $this->listSenders = SenderDestination::get()
        ->where('fixed',1)
        ->whereNull('subsenderdestination_of');
        
        $this->year = date('Y');
        $this->incoming->incoming_no = Incoming::select('incoming_no')
            ->where('year',$this->year)->max('incoming_no') + 1;
    }

    public function render()
    {  
        return view('livewire.incoming.create');
    }

    public function setSender($value)
    {
        $this->incoming->sender_id = $value;
    }

    public function updatedYear($value)
    {
        $this->incoming->incoming_no = Incoming::select('incoming_no')
            ->where('year',$this->year)->max('incoming_no') + 1;
    }

    public function updatedParent($value)
    {   
        if(!empty($value))
        {
            $this->selected_sender = SenderDestination::find($value);
            $this->incoming->sender_id = $value;
        }
    }

    public function setCategory($category)
    {
        $this->incoming->category_id = $category;
    }

    public function submit()
    {   
        $this->validate();
        if($this->parent === '0')
        {
            $sender = SenderDestination::create($this->sender);
            $this->incoming->sender_id = $sender->id; 
        }
        $this->incoming->year = $this->year;
        $this->incoming->save();
        
        //If file is uploaded
        if($this->files)
        {      
            foreach($this->files as $file) 
            {

                $file_name = $file->getClientOriginalName();
                $media = [];
                $media['type']      = 'incoming';
                $media['name']      = $file_name;
                $media['path']      = $file->store(Auth::user()->department->slug.'/incomings/'.date('Y').'/'.date('m'));

                $this->incoming->medias()->create($media);
            }
        }

        session()->flash('success', 'Incoming file added!');
        return redirect(url('staff/incomings'));
    }

    protected function rules(): array
    {
        return [
            'incoming.letter_no' => [
                'string',
            ],
            'incoming.letter_date' => [
                'date',
            ],
            'incoming.category_id' => [
                'integer',
            ],
            'incoming.status' => [
                'string',
            ],
            'incoming.file_no' => [
                'string',
                'required',
            ],
            'incoming.year' => [
                'integer',
            ],
            'incoming.incoming_no' => [
                'integer',
                'required',
            ],
            'incoming.received_date' => [
                'date',
            ],
            'incoming.sender_id' => [
                'integer',
            ],
            'incoming.subject' => [
                'string',
            ],
            'incoming.mode' => [
                'string',
            ],
            'incoming.urgency' => [
                'string',
            ],
            'incoming.remarks' => [
                'string',
            ],
            'incoming.language' => [
                'string',
            ],
        ];
    }
}
