@extends('layout') 
@section('content')






<div class="container " >
    <section class="mx-auto my-5 " style="max-width: 100%; display: flex;justify-content:center">
        
      <div class="card shadow " style="width: 60%">
        <div class="bg-image hover-overlay ripple mb-5 mt-5 " data-mdb-ripple-color="light" style="display: flex;justify-content:center">
          <img src="{{ asset('uploads/resorts/'.$resort['gallery']) }}" width="90%" height="400px" class="text-center" />
          <a href="#!">
            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
          </a>
        </div>
        <div class="card-body text-start" style="padding: 50px">
         

          <h4 class="card-title fw-bold">Resort Name: <a>{{  $resort['name']}}</a></h4>
        
          <h4 class="about fw-bold">Rent per day:{{ $resort['rent_per_day'] }}</h4>
 
          <p class="card-text">
            {{$resort['description']}}
          </p>
          <hr class="my-4" />
          <div class="text-center">
            <a href="/booking/{{ $resort['id'] }}"><button style="width: 150px;margin-top:20px" type="button" class="btn btn-lg btn-primary">Book</button></a>
          </div>
          

        </div>
      </div>
      
    </section>
  </div>



@endsection