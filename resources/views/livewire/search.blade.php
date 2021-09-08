<div x-data="{ advance_filter: false }">
    <div class="flex bodyig mx-auto items-end justify-center">
        <div class="relative rounded-md shadow-sm w-10/12">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span class="text-gray-400 sm:text-sm  md:text-lg pt-2">
                <i class="fas fa-search"></i>
                </span>
            </div>
            <input type="text" name="price" id="price" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-12 pr-4 sm:text-sm border-gray-300 rounded-md py-2 md:text-lg py-2" placeholder="ཨང། / གནད་དོན། / ཟུར་བརྗོད།" wire:model.defer = "subject">
            <div class="absolute inset-y-0 right-0 flex items-center ">
            
                <select id="Currency" name="currency" class="focus:ring-indigo-500 py-2 border-t border-gray-300 border-b bo focus:border-indigo-500 h-full pl-4 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm mg:text-lg" wire:model.debounce.250ms = "type">
                    <option value="incomings">Incomings</option>
                    <option value="outgoings">Outgoings</option>
                </select>

                <select id="Currency" name="currency" class="focus:ring-indigo-500 py-2 border-t border-gray-300 border-b bo focus:border-indigo-500 h-full pl-4 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm" wire:model.defer="filter.year">
                    <option value="">Years</option>
                    @for($year = date('Y') ; $year >= 2000 ; $year--)
                    <option>{{$year}}</option>
                    @endfor
                </select>

                <button type="button" class="py-3 px-4 h-full bg-blue-600 hover:bg-blue-700 focus:ring-blue-500 focus:ring-offset-blue-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold  rounded-r-md" wire:click="$set('search_flag',true)">
                    <i class="fas fa-search"></i>
                </button>

            </div>
        </div>
        <div class="relative">
            <button class="border-b border-indigo-400 text-md ml-3 focus:outline-none text-indigo-400 hover:text-indigo-500 font-semibold hover:border-indigo-500" @click="advance_filter = ! advance_filter">Advance Filter</button>

            <button class="border-b border-red-400 text-md ml-3 focus:outline-none text-red-400 hover:text-red-500 font-semibold hover:border-red-500" wire:click="resetField">Reset</button>
        </div>
    </div>

    <div class="flex flex-col py-2 bg-gray-400 rounded-md px-2 shadow-lg" x-show="advance_filter" x-transition>
        <div class="flex flex-row space-x-1 w-full mb-1">
            <input type="text" class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-1/3 py-1 px-3 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" placeholder="File No.." wire:model.defer="filter.file_no"/>

            <select class="block w-1/6 text-gray-700 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500" name="animals" @if($type=='incomings') wire:model.defer="filter.sender_id" @else wire:model.defer='filter.destination_id' @endif>
                <option value="">Sender/Destination</option>
                @foreach($lists['senderdestinations'] as $key => $value)
                <option value="{{$key}}">{{$value}}</option>
                @endforeach
            </select>

            <select class="block w-1/6 text-gray-700 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500" name="animals" wire:model.defer="filter.category_id">
                <option value="">Category</option>
                @foreach($lists['categories'] as $key => $value)
                <option value="{{$key}}">{{$value}}</option>
                @endforeach
            </select>

            <select class="block w-1/6 text-gray-700 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500" name="animals" wire:model.defer="filter.status">
                <option value="">Status</option>
                <option value="pending">Pending</option>
                <option value="closed">Closed</option>
            </select>

            <select class="block w-1/6 text-gray-700 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500" name="animals" wire:model.defer="filter.urgency">
                <option value="">Urgency</option>
                <option>Urgent</option>
                <option>Moderate</option>
                <option>Not Urgent</option>
            </select>

            <select class="block w-1/6 text-gray-700 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500" name="animals" wire:model.defer="filter.language">
                <option value="">Language</option>
                <option>Tibetan</option>
                <option>English</option>
                <option>Hindi</option>
                <option>Others</option>
            </select>
        </div>

        <div class="flex flex-row space-x-3 w-full">
            
            <div class="w-5/12">
                <label class="font-semibold">Received/Dispatched Date</label>
                <div class="flex flex-row w-full space-x-1">
                    <input type="date" class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-1/2 py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" wire:model.defer="date.date_from"/>
                    <input type="date" class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-1/2 py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" wire:model.defer="date.date_to"/>
                </div>
            </div>

            <div class="w-7/12">
                <label class="font-semibold">Letter Info</label>
                <div class="flex flex-row w-full space-x-1">
                    <input type="text" class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-1/3 py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" placeholder="Letter no.." wire:model.defer="letter.letter_no"/>

                    <input type="date" class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-1/3 py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" wire:model.defer="letter.letter_from"/>

                    <input type="date" class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-1/3 py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" wire:model.defer="letter.letter_to"/>
                </div>
            </div>
        </div>
    </div>

    @if(isset($records))
    @include('staff.table', ['records' => $records,'letter'=>$type])
    @endif

</div>