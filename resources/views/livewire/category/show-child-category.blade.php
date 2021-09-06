<div class="col-span-6">

    @if($category_selected->parent)
        @livewire('category.show-child-category',['category'=>$category_selected->parent], key($category_selected->id))  
    @endif
    <div class="col-span-6 my-2">
        <label for="first-name" class="block text-sm font-medium text-gray-700">
            Category
        </label>
        <select name="first-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2" wire:model="parent">
            <option value=''>Select</option>
            @foreach($categories as $key=>$value)
            <option value={{$key}} >{{$value}}</option>
            @endforeach
        </select>
    </div>

</div>

