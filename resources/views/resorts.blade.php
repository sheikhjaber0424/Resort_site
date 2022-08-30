@extends('layout') 
@section('content')

<h1 class="display-3 text-center my-3">All resorts</h1>
<p class="text-center">only registered users can add, update and delete resorts</p>
<section id="apps">
    
<div class="container custom-rent mb-5">

    @if(Auth::check())
        <div class="text-center">
            <a href="/create"><button class="btn btn-success ">Add resort</button></a>
            {{-- <a href="resorts/create"><button class="btn btn-secondary ">Add resort</button></a> --}}
        
        </div>
    
    
    @endif

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
   
        <div> 
            @if(Auth::check())
            <a href="edit/{{ $item['id'] }} "><button class="btn btn-primary mt-4">Edit</button></a>
            
            <form class="d-inline" action="/delete/{{ $item['id'] }}" method="POST">
                @csrf
                @method('DELETE')

                <a href="/delete/{{ $item['id'] }}"><button class="btn btn-danger mt-4">Delete</button></a>
            </form>
            @endif
        </div>
        </div>



      @endforeach  
    </div>
</div>


@endsection