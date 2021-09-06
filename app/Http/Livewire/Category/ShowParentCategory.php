<?php

namespace App\Http\Livewire\Category;

use Livewire\Component;
use App\Models\Category;

class ShowParentCategory extends Component
{   
    public $categories = [];

    public $parent;
    public $message;
    
    public Category $category_selected;

    public function mount($categories)
    {
        $this->categories = $categories->pluck('title','id')->toArray(); 
    }

    public function render()
    {   
        return view('livewire.category.show-parent-category');
    }

    public function updatedParent($value)
    {   
        if(!empty($value))
        {   
            $this->category_selected = Category::find($value);   //Sets the category as the selected value
            $this->emitUp('parent_selected',$value);
        }
        else
        {   
            if(isset($this->category_selected->parent))
            {
                $this->emitUp('parent_selected',$this->category_selected->parent->id); //Emits the parent value
            }
            else
            {
               $this->emitUp('parent_selected',null); //Emits the null value
            }
            $this->category_selected = new Category;
        }
    }
}
