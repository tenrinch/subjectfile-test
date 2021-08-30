<?php

namespace App\Http\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class Index extends Component
{   
    public $categories;
    public $delete_id;

    public function mount($categories)
    {
        $this->categories = $categories;
        $this->reset('delete_id');
    }

    public function render()
    {
        return view('livewire.category.index');
    }

    public function delete()
    {   
        abort_if(Auth::user()->department_id != Category::find($this->delete_id)->department_id, 
            Response::HTTP_FORBIDDEN, '403 Forbidden');

        Category::findOrFail($this->delete_id)->delete();
        //Category::where('subcategory_of',$this->delete_id)->update(['subcategory_of'=>null]);
        $this->reset('delete_id');

        session()->flash('delete', 'Category deleted!');
        return redirect('staff/categories');
    }
}
