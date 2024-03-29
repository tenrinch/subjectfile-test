<form  wire:submit.prevent="update">
    <div class="shadow sm:rounded-md sm:overflow-hidden bodyig">
        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
            <div class="grid grid-cols-6 gap-6">
                    
                <div class="md:col-span-6 sm:col-span-6">
                    <label class="block text-sm font-medium text-gray-700">
                       Name
                    </label>
                    <input type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model="department.title" required>
                    @error('department.title')
                    <p class="text-xs text-red-600 italic">{{$message}}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <a class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 hover:no-underline" href="{{ url('admin/departments') }}">
                Cancel
            </a>
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Submit
            </button>
        </div>
    </div>
</form>
