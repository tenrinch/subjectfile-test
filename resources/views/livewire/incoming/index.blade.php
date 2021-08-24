<div>
    <div class="w-full flex flex-row justify-between py-2">
        <div class="text-xl uppercase text-leading font-bold text-gray-700">Incoming file</div>
        <div>
            <a class="cursor-pointer bg-blue-500 hover:bg-blue-700 text-white font-bold px-4 rounded py-2.5 hover:no-underline mr-3" 
            href="{{ route('admin.show')}}">
                Show
            </a>
            <a class="cursor-pointer bg-blue-500 hover:bg-blue-700 text-white font-bold px-4 rounded py-2.5 hover:no-underline" 
            href="{{ url('admin/incomings/create')}}">
                Create
            </a>
        </div>
    </div>

    <div>
        <table class="w-full text-sm bg-white mt-3">
            <thead>
                <tr class="uppercase font-semibold text-left text-gray-900 bg-gray-200 border-t border-b border-gray-600">
                    <td class="px-2 py-3 text-xs border-r text-center">#</td>
                    <td class="px-2 py-3 text-xs border-r">Dispatched No</td>
                    <td class="px-2 py-3 text-xs border-r ">Received Date</td>
                    <td class="px-2 py-3 text-xs border-r ">Sender</td>
                    <td class="px-2 py-3 text-xs border-r">Subject</td>
                    <td class="px-2 py-3 text-xs border-r text-center">Status</td>
                    <td class="px-2 py-3 text-xs border-r">File Uploaded</td>
                    <td class="px-2 py-3 text-xs border-r"></td>
                </tr>
            </thead>
            <tbody>
                @foreach($incomings as $incoming)
                <tr>
                    <td class="px-2 py-1 text-xs border text-center">{{$loop->iteration}}</td>
                    <td class="px-2 py-1 text-xs border">
                        <a href="{{url('admin/incomings/show')}}" class="hover:no-underline ">
                            <div class="flex items-center text-sm">
                                <div class="">
                                    <p class="text-xs text-black hover:text-blue-600">{{$incoming->dispatched_no}}</p>
                                </div>
                            </div>
                        </a>
                    </td>
                    <td class="px-2 py-1 text-xs border">{{$incoming->received_date}}</td>
                    <td class="px-2 py-1 text-xs border">{{$incoming->senders->title}}</td>
                    <td class="px-2 py-1 text-xs border">{{$incoming->subject}}</td>
                    <td class="px-2 py-1 text-xs border text-center">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full @if($incoming->status == 'pending') bg-red-100 text-red-800 @else bg-green-100 text-green-800 @endif">
                        {{$incoming->status}}
                        </span>
                    </td>
                    <td class="px-2 py-1 text-xs border">
                        <div class="flex flex-row justify-around">
                            @if($incoming->files)
                                @foreach($incoming->files as $file)
                                <a href="{{ asset('storage')}}/{{$file->path}}" class="hover:no-underline ">
                                    <i class="fas fa-file"></i>
                                </a>
                                @endforeach
                            @endif
                        </div>
                    </td>
                    <td class="px-2 py-1 text-xs border text-center">
                     
                        @can('incoming_delete')
                        <button type="button" wire:click="$set('delete_id', {{ $incoming->id }})" wire:loading.attr="disabled" data-toggle="modal" data-target="#delete_modal" class="ml-auto">
                            <i class="far fa-trash-alt"></i>
                        </button>
                        @endcan
                      
                    </td>
                </tr>
                @endforeach 
            </tbody>
        </table>
    </div>
    @include('livewire.delete-modal')
</div>


