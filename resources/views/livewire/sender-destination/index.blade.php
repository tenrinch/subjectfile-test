<div>
    <div class="w-full flex flex-row justify-between py-2">
        <div class="text-xl uppercase text-leading font-bold text-gray-700">Sender/Destination</div>
        <div>
            <a class="cursor-pointer bg-blue-500 hover:bg-blue-700 text-white font-bold px-4 rounded py-2.5 hover:no-underline" href="{{ url('staff/sender-destinations/create')}}">
                Create
            </a>
        </div>
    </div>

    <div>
        <table class="w-full text-sm bg-white mt-3">
            <thead>
                <tr class="uppercase font-semibold text-left text-gray-900 bg-gray-200 border-t border-b border-gray-600">
                    <td class="px-2 py-3 text-xs border-r text-center">#</td>
                    <td class="px-2 py-3 text-xs border-r">Title</td>
                    <td class="px-2 py-3 text-xs border-r"></td>
                </tr>
            </thead>
            <tbody>
                @foreach($sender_destinations as $sender_destination)
                <tr>
                    <td class="px-2 py-2 text-xs border text-center">{{$loop->iteration}}</td>
                    <td class="px-2 py-2 text-xs border">{{$sender_destination->title}}</td>
                    <td class="px-2 py-2 text-xs border text-center">
                        <div class="w-full flex flex-row justify-around">
                            <a href="{{url('staff/sender-destinations')}}/{{$sender_destination->id}}/edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" wire:click="$set('delete_id', {{ $sender_destination->id }})" wire:loading.attr="disabled" data-toggle="modal" data-target="#delete_modal">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @php
                $parent = $loop->iteration;
                @endphp

                @foreach ($sender_destination->child as $childSenderDestination)
                @include('livewire.sender-destination.child_senderdestination',
                ['child_senderdestination' => $childSenderDestination,'parent_iteration'=>$parent])
                @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
    @include('livewire.delete-modal')
</div>