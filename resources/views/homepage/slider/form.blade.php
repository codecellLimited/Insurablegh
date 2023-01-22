@extends('layouts.app')

@section('web-content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New slider</h1>
        <a href="{{ route('slider') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back
        </a>
    </div>


   <div class="row" style="color:black;">
        <div class="col-12">
            <div class="card shadow">

                <div class="card-body">
                    @if (isset($slider))
                    <form action="{{ route('slider.update') }}" method="post" enctype="multipart/form-data">
                    @else
                    <form action="{{ route('slider.store') }}" method="post" enctype="multipart/form-data">
                    @endif
                        @csrf

                        @isset($slider)
                        <input type="hidden" name="key" value="{{ $slider->id }}">
                        @endisset

                        <div class="form-group">
                            <div class="row">

                                <div class="col-md-4">
                                    <label for=""><b>Slider Image</b></label>
                                    @if(isset($slider))
                                        <img src="{{asset($slider->image)}}" alt="" width="100px" height="100px">
                                    @endif
                                    <input type="file" name="image" 
                                        class="form-control @error('image') is-invalid @enderror">

                                    @error('image')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                            </div>
                        </div>

                        <button class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
   </div>


@endsection