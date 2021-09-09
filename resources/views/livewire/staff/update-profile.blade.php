<form  wire:submit.prevent="updateProfile">
    <div class="shadow sm:rounded-md sm:overflow-hidden bodyig">
        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
            <div class="grid grid-cols-6 gap-6">
                    
                <div class="md:col-span-6 sm:col-span-6">
                    <label class="block text-sm font-medium text-gray-700">
                       Name
                    </label>
                    <input type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.defer="staff.name" required>
                    @error('staff.name')
                    <p class="text-xs text-red-600 italic">{{ $message }}</p>
                    @enderror
                    
                </div>

                <div class="md:col-span-6 sm:col-span-6">
                    <label class="block text-sm font-medium text-gray-700">
                       Email
                    </label>
                    <input type="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.defer="staff.email" required>
                    @error('staff.email')
                    <p class="text-xs text-red-600 italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-6 sm:col-span-6">
                    <label class="block text-sm font-medium text-gray-700">
                       Section
                    </label>
                    <select name="first-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2" wire:model.debounce.250ms="selectSection">
                        <option value=''>Select</option>
                        <option value='0'>Enter New Section</option>
                        @foreach($listSections as $key=>$value)
                        <option value={{$key}}>{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                @if($this->selectSection==='0')
                <div class="md:col-span-6 sm:col-span-6">
                    <label class="block text-sm font-medium text-gray-700">
                       New Section
                    </label>
                    <input type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.defer="section">
                    <p class="text-xs text-red-600 italic">{{ $errors->first('section') }}</p>
                </div>
                @endif
            </div>
        </div>

        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <a class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 hover:no-underline" href="{{ url('coordinator/staff') }}">
                Cancel
            </a>
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Update
            </button>
        </div>
    </div>
</form>