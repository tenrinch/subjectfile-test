@extends('layouts.dashboard')
@section('content')
    
    @include('staff.show',['record'=>$outgoing, 'letter'=>'outgoing'])

@endsection