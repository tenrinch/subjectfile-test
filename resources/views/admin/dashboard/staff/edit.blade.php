@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <div class="w-full bg-gray-100 font-sans overflow-hidden ">

                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Update Staff Profile</h3>
                        </div>
                    </div>
                    
                    <div class="col-span-2">
                        @livewire('staff.update-profile',['staff'=>$staff])
                    </div>
                </div>
                <div class="hidden sm:block" aria-hidden="true">
                    <div class="py-5">
                        <div class="border-t border-gray-200"></div>
                    </div>
                </div>
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Update Staff Password</h3>
                        </div>
                    </div>
                    
                    <div class="col-span-2">
                        @livewire('staff.update-password',['staff'=>$staff])
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection