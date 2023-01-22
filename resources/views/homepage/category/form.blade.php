@extends('layouts.app')

@section('web-content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add a New category</h1>
        <a href="{{ route('category') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back
        </a>
    </div>


   <div class="row">
        <div class="col-12">
            <div class="card shadow">

                <div class="card-body">
                    @if (isset($category))
                    <form action="{{ route('category.update') }}" method="post" enctype="multipart/form-data">
                    @else
                    <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                    @endif
                        @csrf

                        @isset($category)
                        <input type="hidden" name="key" value="{{ $category->id }}">
                        @endisset

                        <div class="form-group">
                            <div class="col-md-4">
                                <label for=""><b>Category Icon</b></label>
                                @if(isset($slider))
                                    <img src="{{asset($slider->icon)}}" alt="" width="50px" height="50px">
                                @endif
                                <input type="file" name="icon" 
                                    class="form-control @error('icon') is-invalid @enderror">

                                @error('icon')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        
                            <div class="col-md-4">
                                <label for="">category Name</label>
                                <input type="text" name="name" autofocus
                                    class="form-control @error('name') is-invalid @enderror"
                                    @if(isset($category))
                                    value="{{ $category->name }}"
                                    @else
                                    value="{{ old('name') }}"
                                    @endif>

                                @error('name')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="">Short Discription</label>
                                <input type="text" name="short_description" autofocus
                                    class="form-control @error('short_description	') is-invalid @enderror"
                                    @if(isset($category))
                                    value="{{ $category->short_description	 }}"
                                    @else
                                    value="{{ old('short_description	') }}"
                                    @endif>

                                @error('short_description	')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>



                        <button class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
   </div>


@endsection