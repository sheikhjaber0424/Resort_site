@extends('layouts.main')
@section('content')

<div class="container mt-5"> 
    <div class="row justify-content-center">
      
      <div class="col-lg-6">

          
  <form action='{{ route('resorts.update', $resort) }}' method="POST" enctype="multipart/form-data">  
      @csrf
      @method('PUT')
      <div class="form-group mb-3">
          <label for="">Name</label>
          <input type="text" name="name" value="{{ $resort['name'] }}" class="form-control">
          
          @error('name')
          <small class="text-danger mt-1"> {{$message}}</small>
          @enderror
      </div>
      <div class="form-group mb-3">
        <label for="">Per day rent</label>
        <input type="text" name="rent_per_day" value="{{ $resort['rent_per_day'] }}" class="form-control" >
        @error('rent_per_day')
        <small class="text-danger mt-1"> {{$message}}</small>
     @enderror
    </div>
      <div class="form-group mb-3">
        <label for="">Description</label>
        <input type="text" name="description" value="{{ $resort['description'] }}" class="form-control" >
        @error('description')
        <small class="text-danger mt-1"> {{$message}}</small>
     @enderror
    </div>
      
      <div class="form-group mb-3 ">
          <label for="">Image</label>
          <input type="file" name="gallery" class="form-control">
          <img class="card-img-top w-50" src="{{ asset('uploads/resorts/'.$resort['gallery']) }}" alt="Card image cap"  height="200px">
          @error('gallery')
          <small class="text-danger mt-1"> {{$message}}</small>
       @enderror
      </div>
      <div class="form-group mb-3 ">
          <button type="submit" class="btn btn-primary">Update </button>
      </div>
      
     
    </form>
  </div>


  </div>
  </div>



@endsection