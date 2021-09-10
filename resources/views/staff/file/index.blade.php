@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <div class="w-full font-sans overflow-hidden">

                @livewire('file.index')

            </div>
        </div>
    </div>
@endsection