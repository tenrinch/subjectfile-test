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
use Illuminate\Support\Str;
use App\Traits\FileUpload;

class Edit extends Component
{
    use FileUpload;

    public Incoming $incoming;

    public $files,$parent;
    public $sender = [];
    public $year,$incoming_no;
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
   
        $this->year = $this->incoming->year;
        $this->incoming_no = $this->incoming->incoming_no;
    }

    public function render()
    {   
        return view('livewire.incoming.edit');
    }

    public function setSender($value)
    {
        $this->incoming->sender_id = $value;
    }

    public function updatedParent($value)
    {   
        if(!empty($value))
        {
            $this->selected_sender = SenderDestination::find($value);
            $this->incoming->sender_id = $value;
        }
    }

    public function updatedYear($value)
    {
        if($value == $this->incoming->year)
        {
            $this->incoming_no = $this->incoming->incoming_no;
        }
        else{
            $this->incoming_no = Incoming::select('incoming_no')
            ->where('year',$this->year)->max('incoming_no') + 1;
        }
    }

    public function setCategory($category)
    {
        $this->incoming->category_id = $category;
    }

    public function update()
    {   
        $this->validate(); 

        if($this->parent === '0')
        {
            $sender = SenderDestination::create($this->sender);
            $this->incoming->sender_id = $sender->id; 
        }

        if($this->incoming->year != $this->year || $this->incoming->incoming_no != $this->incoming_no)
        {
            $this->incoming->year = $this->year;
            $this->incoming->incoming_no = $this->incoming_no;
        }
        $this->incoming->update();
       
        //If file is uploaded
        if($this->files)
        {      
            $this->uploads($this->files,$this->incoming,'incoming');
        }

        session()->flash('success', 'Incoming file updated!');
        return redirect(url('staff/incomings'));
    }

    public function removeFile($media_id)
    {
        Media::find($media_id)->delete();  
        session()->flash('delete', 'File uploaded removed!');
        return redirect(url('staff/incomings/'.$this->incoming->id.'/edit'));
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
                'required',
            ],
            'incoming.incoming_no' => [
                'integer',
                'required',
            ],
            'incoming.received_date' => [
                'date',
                'required',
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
