<div>
    <div class="w-full flex flex-row justify-between py-2">
        <div class="text-xl uppercase text-leading font-bold text-gray-700">Staff</div>
        <div>
            @can('staff_create')
            <a class="cursor-pointer bg-blue-500 hover:bg-blue-700 text-white font-bold px-4 rounded py-2.5 hover:no-underline" 
            href="{{ url('coordinator/staff/create')}}">
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
                    <td class="px-2 py-3 text-xs border-r">Name</td>
                    <td class="px-2 py-3 text-xs border-r">Email</td>
                    <td class="px-2 py-3 text-xs border-r">Last Login</td>
                    <td class="px-2 py-3 text-xs border-r"></td>
                </tr>
            </thead>
            <tbody>
                @foreach($staffs as $staff)
                <tr>
                    <td class="px-2 py-1 text-xs border text-center">{{$loop->iteration}}</td>
                    <td class="px-2 py-1 text-xs border">{{$staff->name}}</td>
                    <td class="px-2 py-1 text-xs border">{{$staff->email}}</td>
                    <td class="px-2 py-1 text-xs border"></td>
                    <td class="px-2 py-1 text-xs border text-center">
                        <div class="w-full flex flex-row justify-around">
                            @can('staff_edit')
                            <a href="staff/{{$staff->id}}/edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            @endcan
                            @can('staff_delete')
                            <button type="button" wire:click="$set('delete_id', {{ $staff->id }})" wire:loading.attr="disabled" data-toggle="modal" data-target="#delete_modal">
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


