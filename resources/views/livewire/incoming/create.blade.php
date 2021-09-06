<div class="md:mt-0 md:col-span-2">
    <form wire:submit.prevent="submit" class="pb-4">
        <div class="shadow sm:rounded-md sm:overflow-hidden bodyig">

            @include('staff.incoming_form',['action'=>'create'])

            <div class="px-4 py-3 bg-gray-200 text-right sm:px-6">
                <a class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 hover:no-underline" href="{{url('staff/incomings')}}">
                    Cancel
                </a>
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Submit
                </button>
            </div>
        </div>
    </form>
</div>