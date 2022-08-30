@extends('layout') 
@section('content')

<div class="container">
	<div class="row">
		
        
        <div class="col-md-12">
        <h4 class="display-4 text-center my-5">Booking List</h4>
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


                
            </div>
            
        </div>
	</div>
</div>




    @endsection