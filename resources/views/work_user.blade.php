<!-- งานใหม่ user -->

@extends('layoutuser')

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



@if(isset($jo))

<br>
<div class="container">
  	<h2>รายการใหม่ User</h2>


	

	<br>
	<div class="table-responsive">          
		<table class="table table-bordered">
			<thead>
				<footer>งานของฉัน</footer>
				<tr>
					<th>Date</th>
					<th>รูป</th>
					<th>Name</th>
					<th>ระยะดำเนินการ</th>
					<th>ปุ่ม</th>
				</tr>
			</thead>




	        <tbody>
				@foreach($jo   as $camera)
				@if (Auth::user()->id == $camera->id  )
				@if ($camera->work_com == "0" )

	                <tr>
						<td>{{$camera->work_date}}</td>
						<td>{{$camera->work_pic}}</td>
						<td><b>{{$camera->camera_name}} </b> <br>
						{{$camera->history_des}}</td>
						<td>{{$camera->work_des}}</td>
						
						<td>
							<a class="btn btn-success btn-md" id="express" href="{{url('user/work_user/'.$camera->work_id.'/work_report') }}"><i class="fa fa-check-square"></i> รายงาน</a>

	 						<a class="btn btn-info btn-md" id="express" href="{{url('user/work_user/'.$camera->work_id.'/work_1') }}"><i class="fa fa-check-square"></i> ซ่อมเสร็จสิ้น</a>
						</td>

					</tr>

				@endif
				@endif
				@endforeach
			</tbody>
		</table>
	</div>

	

</div>


@endif






<script>
  
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});



</script>



@stop