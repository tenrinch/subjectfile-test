<?php

namespace App\Http\Livewire\File;

use Livewire\Component;
use App\Models\File;
use App\Models\Category;

class Create extends Component
{   
    public File $file;
    
    public $category, $label;

    public $lists = [];

    protected $listeners = ['parent_selected' => 'setCategory','sender_destination_selected'=>'setSender'];

    public function mount(File $file)
    {   
        $this->file = $file;
        $this->category = '';
    }

    public function render()
    {
        return view('livewire.file.create');
    }

    public function setCategory($value)
    {
        $this->file->categorized_id = $value;
    }

    public function updatedCategory($value)
    {
        if($value == 'category')
        {
            $this->lists = Category::get()->whereNull('subcategory_of');
            $this->label = 'Select Category';
        }
    }

    public function submit()
    {

        $this->validate();
        $this->file->save();

        session()->flash('success', 'File created!');
        return redirect(url('files/created'));
    }

    protected function rules(): array
    {
        return [
            'file.file_no' => [
                'string',
                'required',
            ],
            'file.date_opened' => [
                'date',
            ],
            'file.section_id' => [
                'integer|nullable',
            ],
            'file.file_name' => [
                'string',
            ],
            'file.remarks' => [
                'string',
            ],
            'file.register_no' => [
                'nullable',
            ],
            'file.remarks' => [
                'string',
            ],
            'file.dealing_staff' => [
                'string',
            ],
            'file.remarks' => [
                'string',
            ]
        ];
    }
}
