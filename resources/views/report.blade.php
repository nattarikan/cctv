
<!-- หน้างานใหม่ Admin -->

@extends('layoutadmin')

@section('title','All camera')

@section('content')




@if(isset($jo))

<br>
<center><h3>กรุณาเลือกช่างหน้างาน</h3></center>

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
				<th>ปุ่ม</th>
			</tr>
		</thead>
        

        <tbody> 	

		@foreach($cctv   as $camera)

		@if ($camera->id_posted == 0 && $camera->id_post  ==1)
		@if ($camera->history_des != 'Ready')

            <tr>
				<td>{{$camera->history_id}}</td>
				<td>{{$camera->camera_name}}</td>
				<td>{{$camera->camera_server}}</td>
				<td>{{$camera->history_des}}</td>
				<td>{{$camera->history_date}}</td>
					

				<td>
					เจ้าหน้าที่ CCTV : {{    $camera->name  }}
				</td>


				<td>	
					<a class="btn btn-success btn-md" id="express" href="{{url('admin/camera/'.$camera->camera_id.'/Select') }}"><i class="fa fa-check-square"></i></a>
				</td>
			</tr>

		@endif
		@endif
		@endforeach
		@endif



        </tbody>	
	</table>
</div>


<!-- ------------------------------------------------------------------- -->

<br>
<center><h3>งานที่กำลังทำ</h3></center>

@if(isset($jo))


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
					<th>ปุ่ม</th>
				</tr>
		</thead>
       

       	<tbody>

		@foreach($jo   as $camera)


		@if ($camera->id_post == 2 && $camera->id_posted == 1)
		@if ($camera->history_des != 'Ready' )


            <tr>
				<td>{{$camera->history_id}}</td>
				<td>{{$camera->camera_name}}</td>
				<td>{{$camera->camera_server}}</td>
				<td>{{$camera->history_des}}</td>
				<td>{{$camera->history_date}}</td>
					

				<td>	
					ช่างหน้างาน : {{    $camera->name  }}
				</td>


				<td>
					<a class="btn btn-primary btn-md" id="express" href="{{url('admin/camera/'.$camera->camera_id.'/Select') }}"><i class="fa fa-check-square"></i> ดูความเคลื่อนไหว</a>

				
				

		@endif
		@endif

		@if ($camera->id_post == 1 && $camera->id_posted == 2)		
					<a class="btn btn-success btn-md" id="express" href="{{url('admin/camera/'.$camera->camera_id.'/Select') }}"><i class="fa fa-check-square"></i>อนุมัติการซ่อม</a>
		@endif




		@endforeach
</td>

            </tr>
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