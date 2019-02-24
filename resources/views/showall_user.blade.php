@extends('layoutuser')

@section('title','All camera')

@section('content')





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
						<a class="btn btn-success btn-md" id="express" href="{{url('user/camera/'.$camera->camera_id.'/declare_user') }}"><i class="fa fa-check-square"></i></a>
					@endif

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