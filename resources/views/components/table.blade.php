<table class="w-full bg-white mt-3 mb-2 bodyig">
    <thead>
        <tr class="uppercase font-semibold text-left text-gray-900 bg-gray-200 border-t border-b border-gray-600">

            <td class="px-2 py-3 text-center">{{ $letter == 'incomings' ? 'Registration No' : 'Dispatched No' }}</td>
            <td class="px-2 py-3">{{ $letter == 'incomings' ? 'Recieved Date' : 'Dispatched Date' }}</td>
            <td class="px-2 py-3">{{ $letter == 'incomings' ? 'Sender' : 'Destination' }}</td>
            <td class="px-2 py-3">Subject</td>
            <td class="px-2 py-3">File no</td>
            <td class="px-2 py-3">Status</td>
            
            <td class="px-2 py-3">Files</td>
            <td class="px-2 py-3"></td>

        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr class="text-xs">
            <td class="p-2 border-b text-center">
                <p>{{ $letter == 'incomings' ? $record->incoming_no : $record->dispatched_no }}</p>
                            
            </td>
            <td class="p-2 border-b">{{$letter == 'incomings' ? $record->received_date : $record->dispatched_date }}</td>
            <td class="px-2 py-1 border-b">
                @if($letter == 'incomings')
                    {{$record->senders->title}}
                @else
                    {{$record->destinations->title}}
                @endif
            </td>
            <td class="p-2 border-b">{{$record->subject}}</td>
            <td class="p-2 border-b">{{$record->file_no}}</td>
            <td class="p-2 border-b">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full @if($record->status == 'pending') bg-red-100 text-red-800 @else bg-green-100 text-green-800 @endif">
                {{$record->status}}
                </span>
            </td>
            
            <td class="p-2 border-b">
                <div class="flex flex-row justify-around">
                    @if($record->files)
                        @foreach($record->files as $file)
                        <a href="{{ asset('storage')}}/{{$file->path}}" class="hover:no-underline" target="_blank">
                            <i class="fas fa-file"></i>
                        </a>
                        @endforeach
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