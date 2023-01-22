@extends('layouts.app')

@section('page_title', 'slider')
   
@section('web-content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">slider</h1>
        <a href="{{ route('slider.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add new image
        </a>
    </div>


   <div class="row" >
        @forelse ($slider as $item)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="my-3 text-center">
                        <img src="{{ asset($item->image) }}" alt="" class="img-fluid m-auto d-block" style="width:300px; height:150px;">
            
                        <button class="btn btn-sm btn-primary"
                        onclick="if(confirm('Are you sure? you are going to delete this record')){ location.replace('delete/{{$item->id}}'); }">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
            <br>
        </div>
        @empty
        <div class="col-12 py-5 text-center">
            <h4 class="text-muted"><b>No Image Yet</b></h4>
        </div>
        @endforelse
   </div>


@endsection