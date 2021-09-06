<div class="px-4 py-5 bg-white space-y-6 sm:p-6">
    @foreach ($errors->all() as $message) 
    {{$message}}
    
    @endforeach
    <div class="grid grid-cols-6 gap-6">
        <div class="col-span-6">
            @livewire('category.show-parent-category',['categories'=>$listCategories])
        </div>

        <div class="lg:col-span-2 md:col-span-3 sm:col-span-6">
             <label class="block text-sm font-medium text-gray-700">
               Year
            </label>
            <select class="p-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model="year">
                @for($i = date('Y'); $i >= 2000; $i--)
                <option>{{$i}}</option>
                @endfor
            </select>     
        </div>

        <div class="lg:col-span-2 md:col-span-3 sm:col-span-6">
            <label class="block text-sm font-medium text-gray-700">
               Incoming Number
            </label>
            @if($action == 'create')
            <input type="text"  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.defer="incoming.incoming_no">
            @else
            <input type="text"  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.defer="incoming_no">
            @endif
        </div>

        <div class="lg:col-span-2 md:col-span-3 sm:col-span-6">
            <label class="block text-sm font-medium text-gray-700">
               Letter Number
            </label>
            <input type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.defer="incoming.letter_no">
            <p class="text-xs text-red-600">{{ $errors->first('incoming.letter_no') }}</p>
        </div>

        <div class="lg:col-span-2 md:col-span-3 sm:col-span-6">
            <label class="block text-sm font-medium text-gray-700">
               Letter Date
            </label>
            <input type="date" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.defer="incoming.letter_date">
            <p class="text-xs text-red-600">{{ $errors->first('incoming.letter_date') }}</p>
        </div>

        <div class="lg:col-span-2 md:col-span-3 sm:col-span-6">
            <label class="block text-sm font-medium text-gray-700">
               Received Date
            </label>
            <input type="date" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.defer="incoming.received_date">
            <p class="text-xs text-red-600">{{ $errors->first('incoming.received_date') }}</p>
        </div>

        <div class="lg:col-span-2 md:col-span-3 sm:col-span-6">
            <label class="block text-sm font-medium text-gray-700">File Number</label>
            <input type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required wire:model.defer="incoming.file_no">
            <p class="text-xs text-red-600">{{ $errors->first('incoming.file_no') }}</p>
        </div>
        
        <div class="col-span-6">
            <label class="block text-sm font-medium text-gray-700">Sender</label>
            <select class="p-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.debounce.250ms="parent">
                <option value=''>Select</option>
                <option value='0'>Enter New Sender</option>
                @foreach($listSenders as $sender)
                <option value="{{$sender->id}}">{{$sender->title}}</option>
                @endforeach
            </select>
            <p class="text-xs text-red-600">{{ $errors->first('incoming.sender') }}</p>
        </div>
        @if(isset($selected_sender) AND count($selected_sender->child))
            @livewire('sender-destination.show-parent',['sender_destinations'=>$selected_sender->child])
        @endif

        @if($parent === '0')
        <div class="col-span-4">
            <label class="block text-sm font-medium text-gray-700">New Sender</label>
            <input type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.defer="sender.title">
            <p class="text-xs text-red-600">{{ $errors->first('sender') }}</p>
        </div>

        <div class="col-span-2">
            <label for="last-name" class="block text-sm font-medium text-gray-700">Recurring Sender</label>
            <input type="radio"  name="sender" value="1" wire:model.defer="sender.fixed">
            <label for="html">Yes</label>
            <input type="radio"  name="sender" value="0" class="ml-3" wire:model.defer="sender.fixed">
            <label for="css">No</label>              
        </div>
        @endif

        <div class="md:col-span-6 sm:col-span-6">
            <label class="block text-sm font-medium text-gray-700">Subject</label>
            <input type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.defer="incoming.subject">
            <p class="text-xs text-red-600">{{ $errors->first('incoming.subject') }}</p>
        </div>

        <div class="lg:col-span-2 md:col-span-3 sm:col-span-6">
            <label for="last-name" class="block text-sm font-medium text-gray-700">Mode</label>
            <select class="p-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.defer="incoming.mode">
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
            <select class="p-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.defer="incoming.urgency">
                <option value="">Select</option>
                <option>Urgent</option>
                <option>Moderate</option>
                <option>Not Urgent</option>
            </select>                     
        </div>

        <div class="lg:col-span-2 md:col-span-3 sm:col-span-6">
            <label for="last-name" class="block text-sm font-medium text-gray-700">Status</label>
            <input type="radio"  name="gender" value="pending" wire:model.defer="incoming.status">
            <label for="html">Pending</label>
            <input type="radio"  name="gender" value="closed" class="ml-3" wire:model.defer="incoming.status">
            <label for="css">Closed</label>              
        </div>

        <div class="md:col-span-6 sm:col-span-6">
            <label class="block text-sm font-medium text-gray-700">Remarks</label>
            <input type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.defer="incoming.remarks">
            <p class="text-xs text-red-600">{{ $errors->first('incoming.remarks') }}</p>
        </div>
        
        <div class="col-span-2">
            <label for="last-name" class="block text-sm font-medium text-gray-700">Language</label>
            <select class="p-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model.defer="incoming.language">
                <option value="">Select</option>
                <option>Tibetan</option>
                <option>English</option>
                <option>Hindi</option>
                <option>Others</option>
            </select>                     
        </div>

        <div class="col-span-4">
            @if($action == 'create')
                @include('components.upload-file')
            @else
                @include('components.uploaded-file',['medias'=>$incoming->files])
            @endif
        </div>

    </div>
</div>