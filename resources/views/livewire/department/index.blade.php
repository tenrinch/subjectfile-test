<div>
    <div class="w-full flex flex-row justify-between py-2">
        <div class="text-xl uppercase text-leading font-bold text-gray-700">Departments</div>
        <div>
            <a class="cursor-pointer bg-blue-500 hover:bg-blue-700 text-white font-bold px-4 rounded py-2.5 hover:no-underline" 
            href="{{ url('admin/departments/create')}}">
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
                    <td class="px-2 py-3 text-xs border-r"></td>
                </tr>
            </thead>
            <tbody>
                @foreach($departments as $department)
                <tr>
                    <td class="px-2 py-1 text-xs border text-center">{{$loop->iteration}}</td>
                    <td class="px-2 py-1 text-xs border">{{$department->title}}</td>
                    <td class="px-2 py-1 text-xs border text-center">
                        <div class="w-full flex flex-row justify-around">
                            <a href="{{'departments'}}/{{$department->id}}/edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" wire:click="$set('delete_id', {{ $department->id }})" wire:loading.attr="disabled" data-toggle="modal" data-target="#delete_modal">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach 
            </tbody>
        </table>
    </div>
    @include('livewire.delete-modal')
</div>


