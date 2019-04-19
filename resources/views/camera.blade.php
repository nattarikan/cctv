@extends('layoutadmin')

@section('title','History)

@section('content')




@if(isset($objs))

<br><br>
<div class="table-responsive">          
	<table class="table">
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Server</th>	
				<th>Last Status</th>	
				<th>Date</th>
				<th>Action</th>
			</tr>
		</thead>


        <tbody>
		@foreach($jo   as $camera)
			<tr>
				<td>{{$camera->history_id}}</td>
				<td>{{$camera->camera_name}}</td>
				<td>{{$camera->camera_server}}</td>
				<td>{{$camera->history_des}}</td>
				<td>{{$camera->history_date}}</td>
				<td>{{$camera->history_do}}</td>	
			</tr>

		@endforeach


        </tbody>	
	</table>
</div>

@endif







<script>
  
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});



</script>



@stop