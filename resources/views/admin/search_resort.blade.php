@extends('layouts.main') 
@section('content')

<div class="container">
	<div class="row">
		
        
        <div class="col-md-12">
        <h4 class="display-4 text-center my-5">Resort Data</h4>
        <div class="container d-flex justify-content-center my-4"> 
            <form action="/admin/searchData" class="d-flex">
            <input style="width:300px " class="form-control me-2" type="text" name="query" placeholder="Search" aria-label="Search">
            <button style="width:100px" class="btn btn-outline-dark rounded-pill me-2" type="submit">Search</button>
          </form> 
        </div>    
 
        <div class="table-responsive">

                
              <table id="mytable" class="table table-bordred table-striped">
                   
                   <thead>
                   
                   <th>ID</th>
                   <th>Name</th>
                    <th>Rent per day</th>
                     <th>Description</th>
                     <th>Image</th>
                     <th>Edit</th>
                      <th>Delete</th>
                      
                   </thead>
    <tbody>
    

 @foreach ($resorts as $item)
     
   
    <tr>
    
  
    <td>{{ $item['id'] }}</td>
    <td>{{ $item['name'] }}</td>
    <td>{{ $item['rent_per_day'] }}</td>
    <td>{{ $item['description'] }}</td>
    <td><img class="card-img-top " src="{{ asset('uploads/resorts/'.$item['gallery']) }}" alt="Card image cap" height="80"> </td>
    <td> <a href="/admin/edit/{{ $item['id'] }} "><button class="btn btn-primary mt-4"><i class="bi bi-pencil-square"></i></button></a></td>
    <td><form class="d-inline" action="/delete/{{ $item['id'] }}" method="POST">
        @csrf
        @method('DELETE')

        <a href="/delete/{{ $item['id'] }}"><button class="btn btn-danger mt-4"><i class="bi bi-trash-fill"></i></button></a>
    </form></td>
    </tr>
    

    @endforeach     
      
    </tbody>
        
</table>

{{-- <div class="d-flex justify-content-center my-4">
    {{  $resorts->links()}}
</div> --}}
                
            </div>
            
        </div>
	</div>
</div>




    @endsection