@extends('layout') 
@section('content')
    
    <div class="container my-5"> 
      <div class="row justify-content-center">
        
        <div class="col-lg-6">
    <form action='/save' method="POST">
        @csrf
        <div class="display-4 text-center mb-5">Booking Form</div>
        <input class="d-none" type="text" name="resort_id" value="{{ $resort['id'] }}">
        <!-- 2 column grid layout with text inputs for the first and last names -->
          <div class="form-outline mb-4">
          <input type="text" name="name" id="form6Example3" class="form-control" required/>
          <label class="form-label" for="form6Example3"><i class="bi bi-person-fill"></i> Full name</label>
        </div>
      
     
      
     
      
        <!-- Email input -->
        <div class="form-outline mb-4">
          <input type="email" name="email" id="form6Example5" class="form-control" required/>
          <label class="form-label" for="form6Example5"><i class="fa fa-solid fa-envelope"></i></i>
            Email</label>
        
        </div>
      
        <!-- Number input -->
        <div class="form-outline mb-4">
          <input type="number" name="phone" id="form6Example6" class="form-control" required/>
          <label class="form-label" for="form6Example6"><i class="fa fa-solid fa-phone"></i> Phone</label>
        </div>

     

        <div class="form-outline mb-4">
            <input type="text" name="members" id="form6Example3" class="form-control" required/>
            <label class="form-label" for="form6Example3"><i class="bi bi-people-fill"></i> Total members</label>
          </div>
        <!-- Message input -->
     
         
        <!-- Checkbox -->
        
        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block mb-4">Confirm booking</button>
      </form>
    </div>


    </div>
    </div>
@endsection