<div>
    <div class="w-full flex flex-row justify-between py-2">
        <div class="text-xl uppercase text-leading font-bold text-gray-700">Files</div>
        <div>
           
            <a class="cursor-pointer bg-blue-500 hover:bg-blue-700 text-white font-bold px-4 rounded py-2.5 hover:no-underline" 
            href="{{ url('staff/files/create')}}">
                Create
            </a>
            
        </div>
    </div>

    <div class="pb-4">
        <div class="flex flex-row">
            <select wire:model="perPage" class="appearance-none h-full border-l rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block appearance-none  bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500">
            @foreach($paginationOptions as $value)
            <option value="{{ $value }}">{{ $value }}</option>
            @endforeach
            </select>
        </div>
        
        @includeIf('staff.file.table')
        
    </div>
    @include('livewire.delete-modal')
</div>


