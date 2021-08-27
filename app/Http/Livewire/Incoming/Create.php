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

    public $files;

    public $listCategories = [];
    public $listSenders = [];

    protected $listeners = ['parent_selected' => 'setCategory'];

    public function mount(Incoming $incoming)
    {   
        $this->incoming = $incoming;
        $this->listCategories = Category::get()->whereNull('subcategory_of');
        $this->listSenders = SenderDestination::get()
        ->where('fixed',1)
        ->pluck('title','id')
        ->toArray();
    }

    public function render()
    {   
        if(!empty($this->incoming->year))
        {
            $this->incoming->incoming_no = Incoming::get()
                ->where('year',$this->incoming->year)
                ->max('incoming_no') + 1;
        }
        else
        {
            $this->incoming->incoming_no = null;
        }

        return view('livewire.incoming.create');
    }

    public function setCategory($category)
    {
        $this->incoming->category_id = $category;
    }

    public function submit()
    {   

        $this->validate();
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
                $media['path']      = $file->storeAs(Auth::user()->department->slug.'/incomings',Str::slug($file_name, '-'));

                $this->incoming->medias()->create($media);
            }
        }

        session()->flash('success', 'Incoming file added!');
        return redirect(url('staff/incomings'));
    }

    protected function rules(): array
    {
        return [
            'incoming.dispatched_no' => [
                'string',
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
            'incoming.sender' => [
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

        ];
    }
}
