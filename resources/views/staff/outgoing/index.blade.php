@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <div class="w-full font-sans overflow-hidden">

                @livewire('outgoing.index')

            </div>
        </div>
    </div>
@endsection