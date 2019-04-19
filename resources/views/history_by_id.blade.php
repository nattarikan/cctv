@extends('layoutadmin')

@section('title','History')

@section('content')


@if(isset($jo))

<br><br>
<div class="table-responsive">          
	<table class="table">
		<thead>
			<tr>
				<!-- <th>ID</th> -->
				<th>Server</th>	
				<th>Name</th>
				<th>Last Date</th>
				<th>Last Status</th>	
				<th>Action</th>
			</tr>
		</thead>


        <tbody>

		@foreach($jo   as $camera )
			<tr>
            @if ($camera->camera_id == $id)
				<!-- <td>{{$camera->history_id}}</td> -->
				<td>{{$camera->camera_server}}</td>
				<td>{{$camera->camera_name}}</td>	
				<td>{{$camera->history_date}}</td>
				<td>{{$camera->history_last}}</td>
				<td>{{$camera->history_do}}</td>
			@endif	
			</tr>
		@endforeach


		</tbody>	
	</table>
</div>

@endif


@stop