<?php

namespace App\Http\Livewire\Category;

use Livewire\Component;
use App\Models\Category;

class ShowChildCategory extends Component
{
    public $categories = [];

    public $parent;
    public $message;
    
    public Category $category_selected;

    protected $listeners = ['parent_selected' => 'setChild'];

    public function setChild($id)
    {
        $this->category_selected = Category::find($id);
        $this->categories = Category::where('subcategory_of',$this->category_selected->subcategory_of)
            ->pluck('title','id')
            ->toArray();
        $this->parent = $this->category_selected->id;

        if(count($this->category_selected->child))
            $this->emitUp('show_child',$this->category_selected);
    }

    public function mount(Category $category)
    {   
        $this->category_selected = $category;
        $this->categories = Category::where('subcategory_of',$this->category_selected->subcategory_of)
            ->pluck('title','id')
            ->toArray();

        $this->parent = $this->category_selected->id;
    }

    public function render()
    {   
        return view('livewire.category.show-child-category');
    }
    
    public function updatedParent($value)
    {   
        if(!empty($value))
        {   
            //$this->category_selected = Category::find($value);   //Sets the category as the selected value
            $this->emitUp('parent_selected',$value);
        }
        else
        {   
            if(isset($this->category_selected->parent))
            {
                $this->emitUp('parent_selected',$this->category_selected->id); //Emits the parent value
            }
            else
            {
               $this->emitUp('parent_selected',null); //Emits the null value
            }
            $this->category_selected = new Category;
        }
    }
}
