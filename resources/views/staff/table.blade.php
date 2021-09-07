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

<table class="w-full bg-white mt-3 mb-2 bodyig">
    <thead>
        <tr class="text-md uppercase font-semibold text-left text-gray-900 bg-gray-200 border-t border-b border-gray-600">
            <td class="px-2 py-3 text-center">  ཨང། 
                @if($letter == 'incomings')
                    @include('components.table.sort', ['field' => 'incoming_no'])
                @else
                    @include('components.table.sort', ['field' => 'dispatched_no'])
                @endif
            </td>
            <td class="px-2 py-3">
                {{ $letter == 'incomings' ? 'འབྱོར་ཚེས།' : 'གཏོང་ཚེས།' }}
                @if($letter == 'incomings')
                @include('components.table.sort', ['field' => 'received_date'])
                @else
                    @include('components.table.sort', ['field' => 'dispatched_date'])
                @endif
            </td>
            <td class="px-2 py-3">
                {{ $letter == 'incomings' ? 'གཏོང་མཁན།' : 'གཏོང་ཡུལ།' }}
                @if($letter == 'incomings')
                    @include('components.table.sort', ['field' => 'sender_id'])
                @else
                    @include('components.table.sort', ['field' => 'destination_id'])
                @endif
            </td>
            <td class="px-2 py-3">གནད་དོན།</td>
            <td class="px-2 py-3">
                ཡིག་སྣོད་ཨང།
                @include('components.table.sort', ['field' => 'file_no'])
            </td>
            <td class="px-2 py-3"> Status
                @include('components.table.sort', ['field' => 'status'])
            </td>
            <td class="px-2 py-3 text-center"><i class="far fa-images"></i></td>
            <td class="px-2 py-3"></td>

        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr class="text-sm hover:bg-blue-100 cursor-pointer">
            <td class="p-2 border-b text-center ">
                @can(['incoming_view','outgoing_view'])
                <a class="text-blue-400 hover:no-underline" href="{{url('staff')}}/{{$letter}}/{{$record->id}}" >
                {{ $letter == 'incomings' ? $record->incoming_no : $record->dispatched_no }}  
                </a>
                @endcan        
            </td>
            <td class="p-2 border-b">{{$letter == 'incomings' ? $record->received_date : $record->dispatched_date }}</td>
            <td class="px-2 py-1 border-b">
                @if($letter == 'incomings')
                    {{$record->sender->title}}
                @else
                    {{$record->destination->title}}
                @endif
            </td>
            <td class="p-2 border-b w-5/12">{{$record->subject}}</td>
            <td class="p-2 border-b">{{$record->file_no}}</td>
            <td class="p-2 border-b">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full @if($record->status == 'pending') bg-red-100 text-red-800 @else bg-green-100 text-green-800 @endif">
                {{$record->status}}
                </span>
            </td>
            
            <td class="p-2 border-b">
                <div class="flex flex-row justify-around">
                    @if(count($record->files))
                    <a href="{{url('staff')}}/{{$letter}}/{{$record->id}}" class="hover:no-underline"> {{ count($record->files) }} Files</a>
                    @endif
                </div>
            </td>
            <td class="p-2 text-xs border-b text-center">
                <div class="dropdown py-0 w-1/2">
                    <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu">
                        @can(['incoming_view','outgoing_view'])
                        <a class="text-gray-600 py-2 hover:no-underline dropdown-item" href="{{url('staff')}}/{{$letter}}/{{$record->id}}" >
                           <i class="fas fa-exclamation-circle ml-4 top-0 mr-3"></i> View
                        </a>
                        @endcan

                        @can(['incoming_edit','outgoing_edit'])
                        <a class="text-gray-600 py-2 hover:no-underline dropdown-item" href="{{url('staff')}}/{{$letter}}/{{$record->id}}/edit" >
                            <i class="fas fa-edit top-0 ml-4 mr-3"></i>Edit
                        </a>
                        @endcan
                        @can(['incoming_delete','outgoing_delete'])
                        <button class="text-red-400 py-2 hover:text-red-600 dropdown-item" type="button" wire:click="$set('delete_id', {{ $record->id }})" wire:loading.attr="disabled" data-toggle="modal" data-target="#delete_modal" >
                            <i class="far fa-trash-alt ml-4 top-0 mr-3"></i>Delete
                        </button>
                        @endcan
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>