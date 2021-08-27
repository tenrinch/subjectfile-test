@extends('layouts.dashboard')
@section('content')
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="w-1/2 mx-auto bg-white shadow overflow-hidden sm:rounded-lg bodyig mb-5">
        <div class="sm:grid grid-cols-3 gap-20 w-full mx-auto py-15 border-b border-gray-200">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="leading-6 font-bold text-gray-900">
                Incoming no
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                {{$incoming->incoming_no}}
                </p>
            </div>
            <div class=" px-4 py-5 sm:px-6">
                <p class=" text-center text-md leading-6 font-medium text-gray-100 @if($incoming->urgency == 'Urgent') bg-red-600 @elseif($incoming->urgency == 'Moderate') bg-indigo-600 @else bg-green-600 @endif rounded-2xl m-auto py-2 px-2 font-bold">
                {{$incoming->urgency}}        
                </p>
            </div>
            <div class="px-4 py-5 sm:px-6 text-right">
                <h3 class="font-bold leading-6 font-medium text-gray-900">
                Status
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                {{ucfirst($incoming->status)}}
                </p>
            </div>
        </div>
        
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                    Category
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{$incoming->category ? $incoming->category->title : 'Incorrect Category'}}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                    File Number
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{$incoming->file_no}}
                    </dd>
                </div>
                <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                    Sender
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{$incoming->senders ? $incoming->senders->title : 'Incorrect Sender'}}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                    Dispatch Number
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{$incoming->dispatched_no}}
                    </dd>
                </div>
                <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                    Year
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{$incoming->year}}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                    Subject
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{$incoming->subject}}
                    </dd>
                </div>
                <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                    Received Date
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{$incoming->received_date}}
                    </dd>
                </div>
                
                <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                    Mode
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{$incoming->mode}}
                    </dd>
                </div>
                <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                    Attachments 
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
                            @forelse($incoming->files as $file)
                            <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                <div class="w-0 flex-1 flex items-center">
                                    <i class="fas fa-paperclip flex-shrink-0 h-5 w-5 text-gray-400"></i>
                                    <span class="ml-2 flex-1 w-0 truncate">
                                    {{$file->name}}
                                    </span>
                                </div>
                                <div class="ml-4 flex-shrink-0">
                                    <a href="{{ asset('storage')}}/{{$file->path}}" class="font-medium text-indigo-600 hover:text-indigo-500" target="_blank">
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
        <div class="text-xs px-2 py-1 text-gray-500 text-right mb-2">
            Entered on {{\Carbon\Carbon::parse( $incoming->created_at )->toFormattedDateString()}}
        </div>
    </div>
@endsection