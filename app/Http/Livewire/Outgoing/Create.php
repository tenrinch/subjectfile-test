<?php

namespace App\Http\Livewire\Outgoing;

use Livewire\Component;
use App\Models\Outgoing;
use App\Models\Media;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public Outgoing $outgoing;

    public $files;

    public $listCategories = [];

    protected $listeners = ['parent_selected' => 'setCategory'];

    public function mount(Outgoing $outgoing)
    {   
        $this->outgoing = $outgoing;
        $this->listCategories = Category::list()->whereNull('subcategory_of');
    }

    public function render()
    {   
        if(!empty($this->outgoing->year))
        {   
            $this->outgoing->dispatched_no = Outgoing::list()
                ->where('year',$this->outgoing->year)
                ->max('dispatched_no') + 1;
        }
        else
        {
            $this->outgoing->dispatched_no = null;
        }

        return view('livewire.outgoing.create');
    }

    public function setCategory($category)
    {
        $this->outgoing->category_id = $category;
    }

    public function submit()
    {   

        $this->validate();
        $this->outgoing->entered_by     = Auth::id();
        $this->outgoing->department_id  = Auth::user()->department_id; 
        $this->outgoing->save();
       
        //If file is uploaded
        if($this->files)
        {      
            foreach($this->files as $file) 
            {
                $media = [];
                $media['file_id']   = $this->outgoing->id;
                $media['path']      = $file->store(Auth::user()->department->title);

                Media::create($media);
            }
        }

        session()->flash('success', 'outgoing file added!');
        return redirect(url('admin/outgoings'));
    }

    protected function rules(): array
    {
        return [
            'outgoing.dispatched_no' => [
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
                'required',
            ],
            'outgoing.dispatched_date' => [
                'date',
                'required',
            ],
            'outgoing.destination' => [
                'integer',
            ],
            'outgoing.subject' => [
                'string',
            ]
        ];
    }
}
