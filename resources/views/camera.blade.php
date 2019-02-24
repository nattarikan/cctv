@extends('layoutadmin')

@section('title','All camera')

@section('content')


<!-- {{ $jo}} -->
<!-- <a class="btn btn-primary" href="{{url('admin/camera/create')}}"><i class="fa fa-paint-brush"> </i> Create </a> -->

@if(isset($objs))

<br><br>
		<div class="table-responsive">          
		<table class="table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Server</th>	
					<th>Last Status</th>	
					<th>Date</th>
					<th>Technician</th>
					
					
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
					

					<td>
					
							@if ( $camera->id_post == 0)
								ช่างหน้างาน : {{    $camera->name  }}
							@elseif ( $camera->id_post == 1)
								เจ้าหน้าที่ CCTV : {{    $camera->name  }}
							@elseif ( $camera->id_post == 2)
								คืนสถานะพร้อมใช้งาน : {{    $camera->name  }}
							@endif
					
					</td>



					

					</div>
					</td>

                </tr>

@endforeach

@endif

        </tbody>	
</table>
</div>









<script>
  
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});



</script>



@stop