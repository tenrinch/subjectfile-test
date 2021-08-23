<?php

namespace App\Http\Livewire\Category;

use Livewire\Component;
use App\Models\Category;

class Index extends Component
{   
    public $categories;
    
    public function mount($categories)
    {
        $this->categories = $categories;
    }

    public function render()
    {
        return view('livewire.category.index');
    }
}
