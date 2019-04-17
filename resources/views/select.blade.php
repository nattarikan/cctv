<!-- admin เลือกช่าง -->

@extends('layoutadmin')

@section('content')
<div class="container">
  <div class='row'>

<form action="{{ route('admin.camera.select', $data->camera_id ) }}" enctype="multipart/form-data" >

  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
  <br><br>

  <div class="form-group"> 
      <div class="form-group">
        <label for="history_des">Description : </label>
        <br>ชื่อกล้อง : {{ $data->camera_name }} <{{ $data->camera_ip }}>
         <br>Server : {{ $data->camera_server }}
        <br>อาการเสีย : 

        <input  type="text" class="form-control" name="history_des" placeholder="Please Enter" value="{{$data->history_des}}">

      </div>
  </div>

 <div class="form-group"> 
      <div class="form-group">
        <label for="id">กรุณาเลือกช่างหน้างาน : </label>
        <input type="text" class="form-control" name="id" placeholder="Please Enter">
      </div>
  </div>



  <button type="submit" class="btn btn-primary btn-sm">Submit</button>

</form>

  </div>
</div>

@endsection