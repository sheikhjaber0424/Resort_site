@extends('layouts.main') 
@section('content')
    
    <div class="container mt-5"> 
      <div class="row justify-content-center">
        
        <div class="col-lg-6">

           
    <form action='/resorts' method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="">Name</label>
            <input type="text" name="name" class="form-control" >

            @error('name')
               <small class="text-danger mt-1"> {{$message}}</small>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="">Per day rent</label>
            <input type="text" name="rent_per_day" class="form-control">

            @error('rent_per_day')
               <small class="text-danger mt-1"> {{$message}}</small>
            @enderror
        </div>
        
        <div class="form-group mb-3">
            <label for="">Description</label>
            <input type="text" name="description" class="form-control" >

            @error('description')
               <small class="text-danger mt-1"> {{$message}}</small>
            @enderror

        </div>
        
        <div class="form-group mb-3">
            <label for="">Image</label>
            <input type="file" name="gallery" class="form-control">

            @error('gallery')
               <small class="text-danger mt-1"> {{$message}}</small>
            @enderror         
        </div>
    
        <div class="form-group mb-3">
            <button type="submit" class="btn btn-primary">Save </button>
        </div>
        
       
      </form>
    </div>


    </div>
    </div>

@endsection