@extends('layouts.main') 
@section('content')

<div class="container">
	<div class="row">
		
        
        <div class="col-md-12">
        <h4 class="display-4 text-center my-5">Booking List</h4>
        
        <div class="container d-flex justify-content-center my-4"> 
            <form action="/admin/searchBooking" class="d-flex">
            <input style="width:300px " class="form-control me-2" type="text" name="query" placeholder="Search" aria-label="Search">
            <button style="width:100px" class="btn btn-outline-dark rounded-pill me-2" type="submit">Search</button>
          </form> 
        </div> 
        <div class="table-responsive">

                
              <table id="mytable" class="table table-bordred table-striped">
                   
                   <thead>
                   
                    <th>ID</th>
                   <th>Resort ID</th>
                    <th>Email</th>
                     <th>Phone</th>
                     <th>Members</th>
                     <th>Start Date</th>
                      <th>End Date</th>
                      
                   </thead>
    <tbody>
    

 @foreach ($bookings as $item)
     
   
    <tr>
    
  
    <td>{{ $item['id'] }}</td>
    <td>{{ $item['resort_id'] }}</td>
    <td>{{ $item['email'] }}</td>
    <td>{{ $item['phone'] }}</td>
    <td>{{ $item['members'] }}</td>
    <td>{{ $item['start_date'] }}</td>
    <td>{{ $item['end_date'] }}</td>
   
    
    </tr>
    

    @endforeach     
      
    </tbody>
        
</table>

<div class="d-flex justify-content-center my-4">
    {{  $bookings->links()}}
</div>
                
            </div>
            
        </div>
	</div>
</div>




    @endsection