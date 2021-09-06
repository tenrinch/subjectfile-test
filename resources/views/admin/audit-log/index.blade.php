@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <div class="w-full font-sans overflow-hidden">
                <div class="w-full flex flex-row justify-between py-2">
                    <div class="text-xl uppercase text-leading font-bold text-gray-700">
                        {{ trans('cruds.auditLog.title_singular') }}
                        {{ trans('global.list') }}
                    </div>
                </div>

                <div class="w-full mb-2">
                 @livewire('audit-log.index')
                </div>
            </div>
        </div>
    </div>
@endsection