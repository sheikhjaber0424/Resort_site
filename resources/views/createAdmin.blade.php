
@extends('layout') 
@section('content')
<h4 class="display-4 text-center mt-5">Create new Admin</h4>
<div class="container custom-login">
   <div class="row margin-top-10">
        <div class="col-sm-4 mx-auto  mb-5 mt-5" style="margin-top:20%;">
            <form action="/createAdmin" method="POST">
              @csrf
              <div class="mb-3">
                <label for="exampleInputName1" class="form-label">User name</label>
                <input type="text" name="name" class="form-control" required>
                <div id="emailHelp" class="form-text"></div>
              </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email address</label>
                  <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                  <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
                </div>
              
                <button type="submit" class="btn btn-primary">Register</button>
              </form>
        </div>

   </div>
</div>
@endsection