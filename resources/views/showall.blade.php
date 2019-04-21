@extends('layouts.layoutadmin')

@section('title','All camera')

@section('content')


<br>
<div class="row">
	<div class="col-md-6">
		<h1>ข้อมูลกล้องทั้งหมด</h1>
	</div>

	<!-- <div class="col-md-4">
		<form action="/search" method="get">
			<div class="input-group">
				<input type="search" name="search" class="form-control">
				<span class="input-group-prepend">
					<button type="submit" class="btn btn-primary">Search</button>
				</span>
			</div>
		</form>
	</div> -->

	<div class="col-md-2">
		<a class="btn btn-primary" href="{{url('admin/camera/create')}}">
			<i class="fa fa-paint-brush"> </i> Create 
		</a>
	</div>
</div>








@if(isset($objs))

<br><br>
		<div class="table-responsive">          
		<table class="table">
			<thead>
				<tr>
					
					<th>ID</th>
					<th>Name</th>
					<th>Server</th>	
					<th>IP</th>	
					<th>Brand</th>	
					
					<th>Last Status</th>	
					<th>Declare</th>
					
				</tr>
			</thead>
        <tbody>



@foreach($objs   as $camera)

                <tr>
					<td>{{$camera->camera_id}}</td>

					<td><a  id="express" href="{{url('admin/camera/'.$camera->camera_id.'/history') }}">
					{{$camera->camera_name}}
					</a></td>

					<td>{{$camera->camera_server}}</td>
					<td>{{$camera->camera_ip}}</td>
					<td>{{$camera->camera_brand}}</td>
					
					<td>{{$camera->history_des}}</td>
					
					</td>


					<td>
					<div >
					@if($camera->history_des == 'Ready')
						<a class="btn btn-success btn-md" id="express" href="{{url('admin/camera/'.$camera->camera_id.'/Declare') }}"><i class="fa fa-check-square"></i></a>


					@elseif ($camera->history_des != 'Ready')
						<a class="btn btn-primary btn-md" id="express" href="{{url('admin/camera/'.$camera->camera_id.'/Ready') }}"><i class="fa fa-check-square"></i></a>


					@endif
					
					<div class="btn-group-vertical">
					<form action="{{url('admin/camera/'.$camera->camera_id) }}" method="post" onsubmit="return(confirm('Do you want to delete ?'))">
					{{ method_field('DELETE') }}
					{{ csrf_field() }} 
					
					<button type="submit" class="btn btn-danger"><i class="fa fa-trash">  </i></button>
					</form>
					
</div>	 

					</div>
					</td>

                </tr>

@endforeach

@endif

        </tbody>	
</table>
</div>

        <center>
			{{ $objs->render() }}
		</center>



<script>
  
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});



</script>



@stop