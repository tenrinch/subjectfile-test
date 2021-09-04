<div class="col-span-6">
    <div class="col-span-6 my-2">
        <label for="first-name" class="block text-sm font-medium text-gray-700">
            Category
        </label>
        <select name="first-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2" wire:model.debounce.250ms="parent">
            <option value=''>Select</option>
            @foreach($categories as $key=>$value)
            <option value={{$key}}>{{$value}}</option>
            @endforeach
        </select>
    </div>

    @if(isset($category_selected) AND count($category_selected->child))

        @livewire('category.show-parent-category',['categories'=>$category_selected->child], 
        key($category_selected->id))   

    @endif
</div>

