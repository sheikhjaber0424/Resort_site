@extends('layout') 
@section('content')

<h1 class="display-3 text-center my-3">All Resorts</h1>

<section id="apps">
    
<div class="container custom-rent mb-5">



    @if (session('status'))
    <h6 class="alert alert-success mt-3">{{ session('status') }}</h6>
    
@endif
    <div class="rentals " style="display:flex;flex-flow:row;justify-content:start ;flex-wrap:wrap"> 
       
        
     @foreach ($resorts as $item) 
    

    <div class="card shadow p-3 card text-center cardimg border-0 me-5" style="width: 17rem;display:inline-block;margin:40px 0px">
        <img class="card-img-top " src="{{ asset('uploads/resorts/'.$item['gallery']) }}" alt="Card image cap" height="250">   
      
        <div class="card-body">
            <h5>{{ $item['name'] }}</h5>
            <strong class="card-text ">{{ $item['rent_per_day'] }}</strong>           
        </div>
   
        </div>



      @endforeach  
    </div>
</div>


@endsection