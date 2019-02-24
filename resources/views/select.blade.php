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
        <input type="text" class="form-control" name="history_des" placeholder="Please Enter">
      </div>
  </div>

 <div class="form-group"> 
      <div class="form-group">
        <label for="id">ช่างผู้ซ่อม : </label>
        <input type="text" class="form-control" name="id" placeholder="Please Enter">
      </div>
  </div>



  <button type="submit" class="btn btn-primary btn-sm">Submit</button>

</form>

  </div>
</div>

@endsection