
<!-- หน้างานใหม่ Admin -->

@extends('layouts.layoutadmin')

@section('title','All camera')

@section('content')

<style>
	table {
	    border-collapse: collapse;
	    /*width: 100%;*/
	}
	th {
	    text-align: center;
	    padding: 10px;
	    font-size: 16px;
	}

	td {
	    text-align: center;
	    padding: 8px;
	}

	tr:nth-child(even){
		background-color: #e6e6e6;
	}



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

/*auto number row*/
	table tr {
	  	counter-increment: rowNumber;
	}
	table tr td:first-child::before {
	  	content: counter(rowNumber);
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
					<th>#</th>
					<th>ชื่อกล้อง</th>
					<th>Server</th>	
					<th>วันที่มอบหมายงาน</th>
					<th>ช่างผู้รับผิดชอบ</th>
					<th>สถานะ</th>	
					<th>Action</th>
				</tr>
			</thead>
	        

	        <tbody> 	

			@foreach($cctv   as $camera)

			@if ($camera->history_des != 'Ready')

	            <tr>
					<td> </td>
					<td>{{$camera->camera_name}}</td>
					<td>{{$camera->camera_server}}</td>
					<td>{{$camera->work_report_date}}</td>
					<td>เจ้าหน้าที่ CCTV : {{ $camera->name  }}</td>
					<td>{{$camera->history_des}}</td>
				
					<td>	
						<a class="btn btn-success btn-md" id="express" href="{{url('admin/camera/'.$camera->camera_id.'/Select') }}"><i class="fa fa-check-square"></i> </a>
					</td>
				</tr>




			@endif
			@endforeach	

	        </tbody>	
		</table>
	</div>










<br><br>

<div class="table-responsive">          
	<table class="table table-bordered">
		<thead>
			<footer>งานที่กำลังซ่อม</footer>
			<tr>
				<th>#</th>
				<th>ชื่อกล้อง</th>
				<th>Server</th>	
				<th>วันที่มอบหมายงาน</th>
				<th>ช่างผู้รับผิดชอบ</th>
				<th>สถานะ</th>
				<th>ความคืบหน้า</th>
				<th>อนุมัติการซ่อม</th>
			</tr>
		</thead>
        

        <tbody> 	

		@foreach($jo   as $camera)

			
		@if ($camera->work_com_admin == 'ยังไม่เคยส่ง'  )

		@if($camera->history_des != 'Ready')

            <tr>
				<td> </td>
				<td>{{$camera->camera_name}}</td>
				<td>{{$camera->camera_server}}</td>
				<td>{{$camera->work_date}}</td>
				<td>{{ $camera->name  }}</td>
				<td>{{$camera->work_des}}</td>

				<td>
					
					<a class="btn btn-success btn-md" id="express" href="{{url('admin/report/'.$camera->work_id.'/work_report2') }}"><i class="fa fa-check-square"></i> </a>
				
				</td>
				<td>
					@if ($camera->work_com == "ช่างซ่อมเสร็จ")
						<a class="btn btn-primary btn-md" id="express" href="{{url('admin/report/'.$camera->work_id.'/'.$camera->camera_id.'/Ready_2') }}"><i class="fa fa-check-square"> </i></a>
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



