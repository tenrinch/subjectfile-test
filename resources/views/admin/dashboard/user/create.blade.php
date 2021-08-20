@extends('layouts.dashboard')
@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="card bg-blueGray-100">
                <div class="card-header">
                    <div class="card-header-container">
                        <h6 class="card-title">
                            {{ trans('global.create') }}
                            {{ trans('cruds.user.title_singular') }}
                        </h6>
                    </div>
                </div>

                <div class="card-body">
                    @livewire('user.create')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection