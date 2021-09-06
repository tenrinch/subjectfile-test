<div class="w-2/3 mx-auto bg-white shadow overflow-hidden sm:rounded-lg bodyig mb-2">
    <div class="sm:grid grid-cols-3 gap-20 w-full mx-auto py-15 border-b border-gray-200">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
             {{$letter == 'incoming' ? 'Registration Number' : 'Dispatched Number'}}
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-600">
            {{$letter == 'incoming' ? $record->incoming_no : $record->dispatched_no}}
            </p>
        </div>
        <div class=" px-4 py-5 sm:px-6">
            <p class=" text-center text-lg leading-6 font-medium text-gray-100 @if($record->urgency == 'Urgent') bg-red-600 @elseif($record->urgency == 'Moderate') bg-indigo-600 @else bg-green-400 @endif rounded-2xl m-auto py-2 px-2 font-bold">
            {{$record->urgency}}        
            </p>
        </div>
        <div class="px-4 py-5 sm:px-6 text-right">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
            Status
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-600">
            {{ucfirst($record->status)}}
            </p>
        </div>
    </div>
    
    <div class="border-t border-gray-200">
        <dl>
            @if($record->category_id)
            <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                Category
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                @include('components.parent-category',['category'=>$record->category]) {{$record->category->title}}
                </dd>
            </div>
            @endif
            <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                File Number
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{$record->file_no}}
                </dd>
            </div>
            
            <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                {{ $letter == 'incoming' ? 'Sender' :'Destination'}}
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                @if($letter == 'incoming')
                    {{ $record->sender->title }}
                @else
                    <div class="flex flex-row justify-between">
                    {{ $record->destination->title }}
                    @if(count($record->destinations))
                        <div class="c-header-nav-item dropdown ml-6">
                            <a class="c-header-nav-link text-blue-600 hover:no-underline curosr-pointer" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                Cc
                            </a>
                            <div class="dropdown-menu dropdown-menu-right pt-0">
                                <ul class="list-disc">
                                @foreach($record->destinations as $destination)
                                <li class="dropdown-item">
                                    {{$loop->iteration}}. {{$destination->title}}
                                </li>
                                @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
                @endif
                </dd>
            </div>

            <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                Subject
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{$record->subject}}
                </dd>
            </div>

            <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                {{ $letter == 'incoming' ? 'Received Date' :'Dispatched Date'}}
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{$letter == 'incoming' ? $record->received_date : $record->dispatched_date}}
                </dd>
            </div>

            <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                {{ $letter == 'incoming' ? 'Registration Number' : 'Dispatched Number'}}
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{$letter == 'incoming' ? $record->incoming_no : $record->dispatched_no}}
                </dd>
            </div>

            @if($letter == 'incoming')
            <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                Letter Number
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{$record->letter_no}}
                </dd>
            </div>

            <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                Letter Date
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{$record->letter_date}}
                </dd>
            </div>

            @endif

            <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                Year
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{$record->year}}
                </dd>
            </div>

            <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                Mode
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{$record->mode}}
                </dd>
            </div>

            <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                Language
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{$record->language}}
                </dd>
            </div>

            <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                Remarks
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{$record->remarks}}
                </dd>
            </div>

            <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                Attachments 
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
                        @forelse($record->files as $file)
                        <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                            <div class="w-0 flex-1 flex items-center">
                                <i class="fas fa-paperclip flex-shrink-0 h-5 w-5 text-gray-400"></i>
                                <span class="ml-2 flex-1 w-0 truncate">
                                {{ $file->name }}
                                </span>
                            </div>
                            <div class="ml-4 flex-shrink-0">
                                <a href="{{ asset('storage')}}/{{$file->path }}" class="font-medium text-indigo-600 hover:text-indigo-500" target="_blank">
                                View
                                </a>
                            </div>
                        </li>
                        @empty
                        <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm text-red-600">
                            No file uploaded!
                        </li>
                        @endforelse
                    </ul>
                </dd>
            </div>
        </dl>
    </div>
    <div class="hidden sm:block" aria-hidden="true">
        <div class="py-1">
            <div class="border-t border-gray-200"></div>
        </div>
    </div>
    <div class="text-xs px-2 py-1 text-gray-500 text-right my-1">
        Entered on {{\Carbon\Carbon::parse( $record->created_at )->toFormattedDateString()}}
    </div>
</div>
