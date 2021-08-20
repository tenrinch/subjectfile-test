<?php

namespace App\Http\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Arr;

class ShowParentCategory extends Component
{   
    public $categories;

    public $parent;

    public Category $category;

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
            $this->category = Category::find($value);   //Sets the category as the selected value
            $this->emitUp('parent_selected',$value); 
        }
        else
        {   
            if(isset($this->category->parent))
            {
                $this->emitUp('parent_selected',$this->category->parent->id); //Emits the parent value
            }
            else
            {
               $this->emitUp('parent_selected',null); //Emits the null value
            }
            
            $this->category = new Category;
        }
    }
}
