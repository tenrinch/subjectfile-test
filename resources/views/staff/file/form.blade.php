<div class="px-4 py-5 bg-white space-y-6 sm:p-6">
    <div class="grid grid-cols-6 gap-6">

        <div class="lg:col-span-2 md:col-span-3 sm:col-span-6">
            <label class="block text-sm font-medium text-gray-700">
               Register No
            </label>
            <input type="text"  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.defer="file.register_no">
        </div>

        <div class="lg:col-span-2 md:col-span-3 sm:col-span-6">
            <label class="block text-sm font-medium text-gray-700">
               Date Opened
            </label>
            <input type="date"  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.defer="file.date_opened'">
        </div>

        <div class="lg:col-span-2 md:col-span-3 sm:col-span-6">
            <label class="block text-sm font-medium text-gray-700">
               File Number
            </label>
            <input type="text"  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.defer="file.file_no">
        </div>

        <div class="lg:col-span-2 md:col-span-3 sm:col-span-6">
            <label class="block text-sm font-medium text-gray-700">
               Section
            </label>
            <select class="p-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model="file.section_id">
                <option value=''>Select</option>
                <option value='{{ auth()->user()->department->parent ? auth()->user()->department->parent->id 
                    : auth()->user()->department_id}}'>Admin</option>
                @forelse(auth()->user()->department->sections as $section)
                <option value='{{$section->id}}'>{{$section->title}}</option>
                @empty
                @endforelse
            </select>  
            <p class="text-xs italic text-gray-600 py-1">Leave unselected if your section falls under Admin</p>   
        </div>

        <div class="lg:col-span-2 md:col-span-3 sm:col-span-6">
            <label class="block text-sm font-medium text-gray-700">
               Dealing Staff
            </label>
            <input type="text"  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.defer="file.dealing_staff">
        </div>

        <div class="lg:col-span-2 md:col-span-3 sm:col-span-6">
            <label class="block text-sm font-medium text-gray-700">
               Categorized By 
            </label>
            <select class="p-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model="category">
                <option value=''>Select</option>
                <option value='file_name'>File Name</option>
                <option value='category'>Category</option>
                <option value='sender_destination'>Sender/Destinations</option>
            </select>  
        </div>

        <div class="lg:col-span-2 md:col-span-3 sm:col-span-6">
           <label for="last-name" class="block text-sm font-medium text-gray-700">File Type</label>
            <input type="radio"  name="type" value="general" wire:model.defer="file.file_type">
            <label for="html">General</label>
            <input type="radio"  name="type" value="subjectfile" class="ml-3" wire:model.defer="file.file_type">
            <label for="css">Subjectfile</label> 
            <p class="text-xs italic text-gray-600 py-1">Leave unselected if there's no type of files</p>           
        </div>

        @if($category)
        <div class="col-span-4"> 
            @livewire('category.show-parent-category',['categories'=>$lists])
        </div>
        @endif

        <div class="col-span-6">
            <label class="block text-sm font-medium text-gray-700">
               File Name
            </label>
            <input type="text"  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.defer="file.file_name">
        </div>

        <div class="col-span-6">
            <label class="block text-sm font-medium text-gray-700">
               Remarks
            </label>
            <input type="text"  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.defer="file.remarks">
        </div>
    </div>
</div>