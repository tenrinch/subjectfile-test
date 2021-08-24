<?php

namespace App\Http\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{   
    public Category $category;

    public $listCategories = [];

    protected $listeners = ['parent_selected' => 'setParent'];
    
    public function setParent($parent)
    {
        $this->category->subcategory_of = $parent;
    }

    public function mount(Category $category)
    {
        
        $this->category = $category;
        $this->listCategories = Category::list()->whereNull('subcategory_of');
    }

    public function render()
    {
        return view('livewire.category.create');
    }

    public function submit()
    {   
        $this->validate();
        $this->category->department_id  = Auth::user()->department_id; 
        //dd($this->category);
        $this->category->save();

        session()->flash('success', 'Category added!');
        return redirect(url('admin/categories/create'));
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
