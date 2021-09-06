@extends('layouts.dashboard')
@section('content')
    
    @include('staff.show',['record'=>$incoming, 'letter'=>'incoming'])

@endsection