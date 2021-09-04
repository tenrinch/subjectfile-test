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
        @include('staff.table',['letter'=>'incomings','records'=>$incomings])
        {{ $incomings->links() }}
    </div>
    @include('livewire.delete-modal')
</div>


