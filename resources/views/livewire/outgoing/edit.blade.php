<form wire:submit.prevent="update" class="pb-4">
    <div class="shadow sm:rounded-md sm:overflow-hidden bodyig">
        
        @include('staff.outgoing_form',['action'=>'update'])

        <div class="px-4 py-3 bg-gray-200 text-right sm:px-6">
            <a href="{{url('staff/outgoings')}}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Cancel
            </a>
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Update
            </button>
        </div>
    </div>
</form>