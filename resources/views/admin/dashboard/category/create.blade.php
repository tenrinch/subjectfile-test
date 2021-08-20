@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <div class="w-full font-sans overflow-hidden">
                <div class="mx-auto w-2/3">
                    @livewire('category.create')
                </div>
            </div>
        </div>
    </div>
@endsection