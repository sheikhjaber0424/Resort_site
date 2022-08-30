@extends('layout') 
@section('content')

<div class="container">
	<div class="row">
		
        
        <div class="col-md-12">
        <h4 class="display-4 text-center my-5">Resort Data</h4>
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
    <td> <a href="edit/{{ $item['id'] }} "><button class="btn btn-primary mt-4"><i class="bi bi-pencil-square"></i></button></a></td>
    <td><form class="d-inline" action="/delete/{{ $item['id'] }}" method="POST">
        @csrf
        @method('DELETE')

        <a href="/delete/{{ $item['id'] }}"><button class="btn btn-danger mt-4"><i class="bi bi-trash-fill"></i></button></a>
    </form></td>
    </tr>
    

    @endforeach     
      
    </tbody>
        
</table>


                
            </div>
            
        </div>
	</div>
</div>


<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
      </div>
          <div class="modal-body">
          <div class="form-group">
        <input class="form-control " type="text" placeholder="Mohsin">
        </div>
        <div class="form-group">
        
        <input class="form-control " type="text" placeholder="Irshad">
        </div>
        <div class="form-group">
        <textarea rows="2" class="form-control" placeholder="CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan"></textarea>
    
        
        </div>
      </div>
          <div class="modal-footer ">
        <button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>
    
    
    
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
      </div>
          <div class="modal-body">
       
       <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>
       
      </div>
        <div class="modal-footer ">
        <button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>


    @endsection