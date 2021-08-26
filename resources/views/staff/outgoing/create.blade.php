@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <div class="w-full bg-gray-100 font-sans overflow-hidden ">

                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Add Outgoing File</h3>
                            <p class="mt-1 text-sm text-gray-600">
                            Please enter the information for the outgoing letter
                            </p>
                        </div>
                    </div>
                    <div class="md:mt-0 md:col-span-2">
                        @livewire('outgoing.create')
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection