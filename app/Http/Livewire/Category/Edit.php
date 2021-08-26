<?php

namespace App\Http\Livewire\Category;

use Livewire\Component;
use App\Models\Category;

class Edit extends Component
{
    public Category $category;

    public $listCategories = [];

    protected $listeners = ['parent_selected' => 'setParent'];
    
    public function setParent($id)
    {
        $this->category->subcategory_of = $id;
    }

    public function mount($category)
    {
        $this->category = $category;
        if($this->category->parent)
        {
            $this->listCategories = Category::list()->where('subcategory_of',$this->category->subcategory_of);
        }
        else
        {
            $this->listCategories = Category::list()->whereNull('subcategory_of');
        }
        
    }

    public function render()
    {
        return view('livewire.category.edit');
    }

    public function update()
    {   
        $this->validate();
        $this->category->update();

        session()->flash('success', 'Category added!');
        return redirect(url('staff/categories/'));
    }

    protected function rules(): array
    {
        return [
            'category.title' => [
                'string',
                'required',
            ],
            'category.subcategory_of' => [
                'integer'
            ]
        ];
    }
}
