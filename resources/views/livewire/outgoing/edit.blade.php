<form wire:submit.prevent="update" class="pb-4">
    <div class="shadow sm:rounded-md sm:overflow-hidden bodyig">
        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
            <div class="grid grid-cols-6 gap-6" x-data="{ cc: false}">

                <div class="col-span-6">
                    @livewire('category.show-parent-category',['categories'=>$listCategories])
                </div>

                <div class="lg:col-span-2 md:col-span-3 sm:col-span-6">
                    <label class="block text-sm font-medium text-gray-700">Year</label>
                    <select class="p-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model="year">
                        @for($i = date('Y'); $i >= 2000; $i--)
                        <option>{{$i}}</option>
                        @endfor
                    </select>     
                </div>

                <div class="lg:col-span-2 md:col-span-3 sm:col-span-6">
                    <label class="block text-sm font-medium text-gray-700">
                       Dispatched Number
                    </label>
                    <input type="text"  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"  wire:model="dispatched_no">
                    <p class="text-xs text-red-600">{{ $errors->first('dispatched_no') }}</p>
                </div>

                <div class="lg:col-span-2 md:col-span-3 sm:col-span-6">
                    <label class="block text-sm font-medium text-gray-700">
                       Send Date
                    </label>
                    <input type="date" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.defer="outgoing.dispatched_date">
                    <p class="text-xs text-red-600">{{ $errors->first('outgoing.dispatched_date') }}</p>
                </div>

                <div class="lg:col-span-2 md:col-span-3 sm:col-span-6">
                    <label class="block text-sm font-medium text-gray-700">File Number</label>
                    <input type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.defer="outgoing.file_no">
                    <p class="text-xs text-red-600">{{ $errors->first('outgoing.file_no') }}</p>
                </div>

                <div class="lg:col-span-3 md:col-span-5 sm:col-span-5">
                    <label class="block text-sm font-medium text-gray-700">Destination</label>
                    <select class="p-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.defer="outgoing.destination_id">
                        <option value=''>Select</option>
                       @foreach($listDestinations as $key => $value)
                       <option value="{{$key}}">{{$value}}</option>
                       @endforeach
                    </select>
                    <p class="text-xs text-red-600">{{ $errors->first('outgoing.sender') }}</p>
                </div>

                <div class="col-span-1">
                    <label for="last-name" class="block text-sm font-medium text-gray-700">Cc</label>
                    <input type="radio" name="cc" value="1" x-on:click="cc =  true">
                    <label for="html">Yes</label>
                    <input type="radio"  name="cc" value="0" class="ml-1" x-on:click="cc =  false">
                    <label for="css">No</label>              
                </div>


                <div class="col-span-6">
                    <label class="block text-sm font-medium text-gray-700">Select Destinations</label>
                    <x-select-list class="form-control" id="destinations" name="destinations" wire:model="destinations" :options="$listDestinations" multiple />
                </div>
                
                @if($outgoing->destination_id === '0')
                <div class="col-span-4">
                    <label class="block text-sm font-medium text-gray-700">New Destination</label>
                    <input type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.defer="destination.title">
                    <p class="text-xs text-red-600">{{ $errors->first('destination.title') }}</p>
                </div>

                <div class="col-span-2">
                    <label for="last-name" class="block text-sm font-medium text-gray-700">Recurring Destination</label>
                    <input type="radio"  name="sender" value="1" wire:model.defer="destination.fixed">
                    <label for="html">Yes</label>
                    <input type="radio"  name="sender" value="0" class="ml-3" wire:model.defer="destination.fixed">
                    <label for="css">No</label>              
                </div>
                @endif

                <div class="md:col-span-6 sm:col-span-6">
                    <label class="block text-sm font-medium text-gray-700">Subject</label>
                    <input type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.defer="outgoing.subject">
                </div>

                <div class="lg:col-span-2 md:col-span-3 sm:col-span-6">
                    <label for="last-name" class="block text-sm font-medium text-gray-700">Mode</label>
                    <select class="p-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.defer="outgoing.mode">
                        <option value=''>Select</option>
                        <option>By Hand</option>
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

                <div class="md:col-span-6 sm:col-span-6">
                    <label class="block text-sm font-medium text-gray-700">Remarks</label>
                    <input type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.defer="outgoing.remarks">
                    <p class="text-xs text-red-600">{{ $errors->first('outgoing.remarks') }}</p>
                </div>
                
                <div class="col-span-6">
                    @include('components.uploaded-file',['medias'=>$outgoing->files])
                </div>

            </div>
        </div>

        <div class="px-4 py-3 bg-gray-200 text-right sm:px-6">
            <a href="{{url('staff/outgoings')}}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Cancel
            </a>
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Update
            </button>
        </div>
    </div>
</form>