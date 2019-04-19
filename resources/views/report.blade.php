
<!-- หน้างานใหม่ Admin -->

@extends('layoutadmin')

@section('title','All camera')

@section('content')

<style>
	table {
	    border-collapse: collapse;
	    /*width: 100%;*/
	}
	th {
	    text-align: left;
	    padding: 10px;
	    font-size: 16px;
	}

	td {
	    text-align: left;
	    padding: 8px;
	}

	tr:nth-child(even){background-color: #e6e6e6}


	th {
	    background-color: #8FB0A9;
	    color: black;
	}

	footer {
	  	border-collapse: collapse;
	    /*width: 100%;*/
	    text-align: center;
	    padding: 12px;
	    font-size: 20px;
	    background-color: #617F7F;
	    color: white;
	}
</style>




<br>
<div class="container">
  <h2>รายการใหม่ Admin</h2>



	<div class="table-responsive">          
		<table class="table table-bordered">
			<thead>
				<footer>กรุณาเลือกช่างหน้างาน</footer>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Server</th>	
					<th>Last Status</th>	
					<th>Date</th>
					<th>Technician</th>
					<th>Action</th>
				</tr>
			</thead>
	        

	        <tbody> 	

			@foreach($cctv   as $camera)

			@if ($camera->history_des != 'Ready')

	            <tr>
					<td>{{$camera->work_report_id}}</td>
					<td>{{$camera->camera_name}}</td>
					<td>{{$camera->camera_server}}</td>
					<td>{{$camera->history_des}}</td>
					<td>{{$camera->work_report_date}}</td>
						

					<td>
						เจ้าหน้าที่ CCTV : {{    $camera->name  }}
					</td>


					<td>	
						<a class="btn btn-success btn-md" id="express" href="{{url('admin/camera/'.$camera->camera_id.'/Select') }}"><i class="fa fa-check-square"></i> ระบุช่างหน้างาน</a>
					</td>
				</tr>




			@endif
			@endforeach	

	        </tbody>	
		</table>
	</div>









<!-- 
<br>
<center><h3>งานที่กำลังซ่อม</h3></center> -->
<br><br>

<div class="table-responsive">          
	<table class="table table-bordered">
		<thead>
			<footer>งานที่กำลังซ่อม</footer>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Server</th>	
				<th>Date</th>
				<th>Technician</th>
				<th>Last Status</th>
				<th>Action</th>
			</tr>
		</thead>
        

        <tbody> 	

		@foreach($jo   as $camera)

			
		@if ($camera->work_com_admin == 'ยังไม่เคยส่ง'  )

		@if($camera->history_des != 'Ready')

            <tr>
				<td>{{$camera->work_id}}</td>
				<td>{{$camera->camera_name}}</td>
				<td>{{$camera->camera_server}}</td>
				<td>{{$camera->work_date}}</td>
				<td>ช่างที่รับผิดชอบ : {{    $camera->name  }}</td>
				<td>{{$camera->work_des}}</td>

				<td>	
					<a class="btn btn-success btn-md" id="express" href="{{url('admin/report/'.$camera->work_id.'/work_report2') }}"><i class="fa fa-check-square"></i> รายงาน</a>

					@if ($camera->work_com == "ช่างซ่อมเสร็จ")
						<a class="btn btn-primary btn-md" id="express" href="{{url('admin/report/'.$camera->work_id.'/'.$camera->camera_id.'/Ready_2') }}"><i class="fa fa-check-square"> อนุมัติการซ่อม</i></a>
					@endif

				</td>
			</tr>

		@endif
		@endif
		@endforeach	




        </tbody>	
	</table>
</div>

<!--  -->
</div>









<script>
  
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});

</script>



@stop