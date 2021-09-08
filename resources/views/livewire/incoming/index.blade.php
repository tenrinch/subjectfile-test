<div>
    <div class="w-full flex flex-row justify-between py-2">
        <div class="text-xl uppercase text-leading font-bold text-gray-700">Incoming file</div>
        <div>
            @can('incoming_create')
            <a class="cursor-pointer bg-blue-500 hover:bg-blue-700 text-white font-bold px-4 rounded py-2.5 hover:no-underline" 
            href="{{ url('staff/incomings/create')}}">
                Create
            </a>
            @endcan
        </div>
    </div>

    <div class="pb-4">
        <div class=" flex flex-row">
            <select wire:model="perPage" class="appearance-none h-full border-l rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block appearance-none  bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500">
            @foreach($paginationOptions as $value)
            <option value="{{ $value }}">{{ $value }}</option>
            @endforeach
            </select>

            <select class="appearance-none h-full border-l rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block appearance-none w-1/6 bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500" wire:model.debounce.300ms="year">
                <option value=''>All Years</option>
                @for($year = date('Y') ; $year >= 2000 ; $year--)
                <option>{{$year}}</option>
                @endfor
            </select>


            <select class="appearance-none h-full border-l rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block appearance-none w-1/5 bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500" wire:model.debounce.300ms="sender">
                <option value=''>All Senders</option>
                @foreach($lists['senderdestinations'] as $key => $value)
                <option value="{{$key}}">{{$value}}</option>
                @endforeach
            </select>

            <select
                class="appearance-none h-full border-l rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block appearance-none w-1/5 bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500" wire:model.debounce.300ms="file">
                <option value=''>All Files</option>
                @foreach($lists['files'] as $value)
                <option>{{$value}}</option>
                @endforeach
            </select>

            <input placeholder="Search" class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-3 py-1 w-1/4 bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none"  wire:model.debounce.300ms="search"/>
        </div>
        
        @include('staff.table',['letter'=>'incomings','records'=>$incomings])
        
    </div>
    @include('livewire.delete-modal')
</div>


