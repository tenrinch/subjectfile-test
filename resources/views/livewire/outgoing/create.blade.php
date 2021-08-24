<form wire:submit.prevent="submit" class="pb-4">
    <div class="shadow sm:rounded-md sm:overflow-hidden bodyig">
        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
            <div class="grid grid-cols-6 gap-6">

                <div class="col-span-6">
                    @livewire('category.show-parent-category',['categories'=>$listCategories])
                </div>

                <div class="lg:col-span-2 md:col-span-3 sm:col-span-6">
                    <label class="block text-sm font-medium text-gray-700">Year</label>
                    <select class="p-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model="outgoing.year">
                        <option>Select</option>
                        @for($i=2012 ; $i<=2021 ; $i++)
                        <option>{{$i}}</option>
                        @endfor
                    </select>
                    <p class="text-xs text-red-600">{{ $errors->first('outgoing.year') }}</p>
                </div>

                <div class="lg:col-span-2 md:col-span-3 sm:col-span-6">
                    <label class="block text-sm font-medium text-gray-700">
                       Dispatched Number
                    </label>
                    <input type="text"  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" disabled wire:model="outgoing.dispatched_no">
                    <p class="text-xs text-red-600">{{ $errors->first('outgoing.dispatched_no') }}</p>
                </div>

                <div class="lg:col-span-2 md:col-span-3 sm:col-span-6">
                    <label class="block text-sm font-medium text-gray-700">File Number</label>
                    <input type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.defer="outgoing.file_no">
                    <p class="text-xs text-red-600">{{ $errors->first('outgoing.file_no') }}</p>
                </div>

                <div class="lg:col-span-2 md:col-span-3 sm:col-span-6">
                    <label class="block text-sm font-medium text-gray-700">
                       Send Date
                    </label>
                    <input type="date" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.defer="outgoing.dispatched_date">
                    <p class="text-xs text-red-600">{{ $errors->first('outgoing.dispatched_date') }}</p>
                </div>

                <div class="lg:col-span-4 md:col-span-6 sm:col-span-6">
                    <label class="block text-sm font-medium text-gray-700">Destination</label>
                    <select class="p-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.defer="outgoing.destination">
                        <option value=''>Select</option>
                       @foreach($listDestinations as $key => $value)
                       <option value="{{$key}}">{{$value}}</option>
                       @endforeach
                    </select>
                    <p class="text-xs text-red-600">{{ $errors->first('outgoing.sender') }}</p>
                </div>

                <div class="md:col-span-6 sm:col-span-6">
                    <label class="block text-sm font-medium text-gray-700">Subject</label>
                    <input type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.defer="outgoing.subject">
                </div>

                <div class="lg:col-span-2 md:col-span-3 sm:col-span-6">
                    <label for="last-name" class="block text-sm font-medium text-gray-700">Mode</label>
                    <select class="p-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.defer="outgoing.mode">
                        <option value=''>Select</option>
                        <option>Email</option>
                        <option>Post</option>
                        <option>Fax</option>
                        <option>Others</option>
                    </select>         
                </div>

                <div class="lg:col-span-2 md:col-span-3 sm:col-span-6">
                    <label for="last-name" class="block text-sm font-medium text-gray-700">Urgency</label>
                    <select class="p-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.defer="outgoing.urgency">
                        <option value="">Select</option>
                        <option>Urgent</option>
                        <option>Moderate</option>
                        <option>Not Urgent</option>
                    </select>                     
                </div>
                
               <div class="lg:col-span-2 md:col-span-3 sm:col-span-6">
                    <label for="last-name" class="block text-sm font-medium text-gray-700">Status</label>
                    <input type="radio"  name="gender" value="pending" wire:model.defer="outgoing.status">
                    <label for="html">Pending</label>
                    <input type="radio"  name="gender" value="closed" class="ml-3" wire:model.defer="outgoing.status">
                    <label for="css">Closed</label>              
                </div>
                
                <div class="col-span-6">
                    @include('components.upload-file')
                </div>

            </div>
        </div>

        <div class="px-4 py-3 bg-gray-200 text-right sm:px-6">
            <a href="{{url('admin/outgoings')}}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Cancel
            </a>
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Submit
            </button>
        </div>
    </div>
</form>