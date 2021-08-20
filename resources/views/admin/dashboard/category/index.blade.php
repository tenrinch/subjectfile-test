@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <div class="w-full font-sans overflow-hidden">
                <div class="w-full flex flex-row justify-between py-2">
                    <div class="text-xl uppercase text-leading font-bold text-gray-700">File Category</div>
                    <div>
                        <a class="cursor-pointer bg-blue-500 hover:bg-blue-700 text-white font-bold px-4 rounded py-2.5 hover:no-underline" 
                        href="{{ url('admin/categories/create')}}">
                            Create
                        </a>
                    </div>
                </div>

                @livewire('category.index',['categories'=>$categories])
               
            </div>
        </div>
    </div>
@endsection