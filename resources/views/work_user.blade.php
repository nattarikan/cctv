<!-- งานใหม่ user -->

@extends('layoutuser')

@section('title','All camera')

@section('content')


<br>
<center><h3>งานของฉัน</h3></center>

@if(isset($jo))


<br>
		<div class="table-responsive">          
		<table class="table">
			<thead>
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
						
<a class="btn btn-success btn-md" id="express" href="{{url('user/work_user/'.$camera->work_id.'/work_report') }}"><i class="fa fa-check-square"></i></a>

 <a class="btn btn-info btn-md" id="express" href="{{url('user/work_user/'.$camera->work_id.'/work_1') }}"><i class="fa fa-check-square"></i> ซ่อมเสร็จสิ้น</a>
					</td>

@endif

@endif

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