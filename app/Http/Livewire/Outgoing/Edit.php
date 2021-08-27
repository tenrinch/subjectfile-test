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
class Edit extends Component
{
    use WithFileUploads;

    public Outgoing $outgoing;

    public $files;

    public $listCategories = [];
    public $listDestinations = [];

    protected $listeners = ['parent_selected' => 'setCategory'];

    public function mount(Outgoing $outgoing)
    {   
        $this->outgoing = $outgoing;
        $this->listCategories = Category::get()->whereNull('subcategory_of');
        $this->listDestinations = SenderDestination::get()
        ->where('fixed',1)
        ->pluck('title','id')
        ->toArray();
    }

    public function render()
    {   
        if(!empty($this->outgoing->year))
        {
            $this->outgoing->outgoing_no = outgoing::get()
                ->where('year',$this->outgoing->year)
                ->max('outgoing_no') + 1;
        }
        else
        {
            $this->outgoing->outgoing_no = null;
        }

        return view('livewire.outgoing.edit');
    }

    public function setCategory($category)
    {
        $this->outgoing->category_id = $category;
    }

    public function update()
    {   
        $this->validate(); 
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

        session()->flash('success', 'outgoing file added!');
        return redirect(url('staff/outgoings'));
    }

    public function removeFile($media_id)
    {
        $this->outgoing->files->where('id',$media_id)->delete(); 
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
            'outgoing.destination' => [
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

        ];
    }
}
