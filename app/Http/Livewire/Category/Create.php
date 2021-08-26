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
    
    public function setParent($id)
    {
        $this->category->subcategory_of = $id;
    }

    public function mount(Category $category)
    {
        $this->category = $category;
        $this->listCategories = Category::get()->whereNull('subcategory_of');
    }

    public function render()
    {
        return view('livewire.category.create');
    }

    public function submit()
    {   
        $this->validate();
        $this->category->save();

        session()->flash('success', 'Category added!');
        return redirect(url('staff/categories/create'));
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
