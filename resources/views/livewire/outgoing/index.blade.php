<div>
    <div class="w-full flex flex-row justify-between py-2">
        <div class="text-xl uppercase text-leading font-bold text-gray-700">Outgoing files</div>
        <div>
            @can('outgoing_create')
            <a class="cursor-pointer bg-blue-500 hover:bg-blue-700 text-white font-bold px-4 rounded py-2.5 hover:no-underline" 
            href="{{ url('staff/outgoings/create')}}" class="">
                Create
            </a>
            @endcan
        </div>
    </div>

    <div>
        <table class="w-full text-sm bg-white mt-3">
            <thead>
                <tr class="uppercase font-semibold text-left text-gray-900 bg-gray-200 border-t border-b border-gray-600">
                    <td class="px-2 py-3 text-xs border-r text-center">#</td>
                    <td class="px-2 py-3 text-xs border-r">File no</td>
                    <td class="px-2 py-3 text-xs border-r ">Send Date</td>
                    <td class="px-2 py-3 text-xs border-r ">Destination</td>
                    <td class="px-2 py-3 text-xs border-r">Subject</td>
                    <td class="px-2 py-3 text-xs border-r text-center">Status</td>
                    <td class="px-2 py-3 text-xs border-r text-center">Files</td>
                    <td class="px-2 py-3 text-xs border-r"></td>

                </tr>
            </thead>
            <tbody>
                @foreach($outgoings as $outgoing)
                <tr>
                    <td class="px-2 py-1 text-xs border text-center">{{$loop->iteration}}</td>
                    <td class="px-2 py-1 text-xs border">
                        <a href="{{url('staff/outgoings/show')}}" class="hover:no-underline ">
                            <div class="flex items-center text-sm">
                                <div class="">
                                    <p class="text-xs text-black hover:text-blue-600">{{$outgoing->file_no}}</p>
                                </div>
                            </div>
                        </a>
                    </td>
                    <td class="px-2 py-1 text-xs border">{{$outgoing->dispatched_date}}</td>
                    <td class="px-2 py-1 text-xs border">{{$outgoing->destinations->title}}</td>
                    <td class="px-2 py-1 text-xs border">{{$outgoing->subject}}</td>
                    <td class="px-2 py-1 text-xs border text-center">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full @if($outgoing->status == 'pending') bg-red-100 text-red-800 @else bg-green-100 text-green-800 @endif">
                        {{$outgoing->status}}
                        </span>
                    </td>
                    <td class="px-2 py-1 text-xs border">
                        <div class="flex flex-row justify-around">
                            @if($outgoing->files)
                                @foreach($outgoing->files as $file)
                                <a href="{{ asset('storage')}}/{{$file->path}}" class="hover:no-underline" target="_blank">
                                    <i class="fas fa-file"></i>
                                </a>
                                @endforeach
                            @endif
                        </div>
                    </td>
                    <td class="px-2 py-1 text-xs border text-center">
                        <div class="w-full flex flex-row justify-around">
                            @can('outgoing_view')
                            <a href="{{url('staff/outgoings')}}/{{$outgoing->id}}">
                                <i class="fas fa-info-circle"></i>
                            </a>
                            @endcan
                            @can('outgoing_edit')
                            <a href="{{url('staff/outgoings')}}/{{$outgoing->id}}/edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            @endcan
                            @can('outgoing_delete')
                            <button type="button" wire:click="$set('delete_id', {{ $outgoing->id }})" wire:loading.attr="disabled" data-toggle="modal" data-target="#delete_modal" class="text-red-600">
                                <i class="far fa-trash-alt"></i>
                            </button>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('livewire.delete-modal')
</div>



