<tr>
    <td class="px-2 py-2 text-sm border">{{$parent_iteration}}.{{$loop->iteration}}</td>
    <td class="px-2 py-2 text-sm border">
        {{$child_senderdestination->title}}
    </td>
    <td class="px-2 py-2 text-sm border text-center">
        <div class="w-full flex flex-row justify-around">
            <a href="{{url('staff/sender-destinations')}}/{{$child_senderdestination->id}}/edit">
                <i class="fas fa-edit"></i>
            </a>
            <button type="button" wire:click="$set('delete_id', {{ $child_senderdestination->id }})" wire:loading.attr="disabled" data-toggle="modal" data-target="#delete_modal">
                <i class="far fa-trash-alt"></i>
            </button>
        </div>
    </td>
</tr>
@php
    $parent = $parent_iteration.'.'.$loop->iteration;
@endphp
@foreach ($child_senderdestination->child as $childSenderDestination)
    @include('livewire.sender-destination.child_senderdestination', ['child_senderdestination' => $childSenderDestination, 'parent_iteration'=>$parent])
@endforeach