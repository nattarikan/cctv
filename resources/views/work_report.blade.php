<!-- ช่างรายงานความคืบหน้า -->

@extends('layoutuser')

@section('content')


<div class="container">
  <div class='row'>


    <form action="{{ route('user.work_user.get_work_report', $data->work_id ) }}" enctype="multipart/form-data" >






  
<input id="camera_id" name="camera_id" type="hidden" value="{{$data->camera_id}}">






    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

    <br><br>

    <div class="form-group"> 
      <div class="form-group">
        <label for="history_des">รูปภาพ : </label>
        <input type="file" class="form-control" name="work_pic" placeholder="Please Enter">
      </div>
    </div>

    <div class="form-group"> 
      <div class="form-group">
        <label for="id">รายละเอียดการดำเนินการ : </label>
        <input type="text" class="form-control" name="work_des" placeholder="Please Enter">
      </div>
    </div>

    <button type="submit" class="btn btn-primary btn-sm">ส่งความคืบหน้า</button>

      <a class="btn btn-info btn-md" id="express" href="{{url('user/work_user/'.$data->work_id.'/work_1') }}"><i class="fa fa-check-square"></i> ซ่อมเสร็จสิ้น</a>
    </form>

  </div>
</div>





@if(isset($data))


<br>
<div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
        <th>Date</th>
        <th>รูป</th>
        <th>Name</th>
        <th>ระยะดำเนินการ</th>
      </tr>
    </thead>
    


    <tbody>

    @foreach($jo  as $camera)

    @if (Auth::user()->id == $camera->id  )
    @if ($camera->work_com == 0 )
    @if($data->work_id == $camera->work_id)

      <tr>
        <td>{{$camera->work_date}}</td>
        <td>{{$camera->work_pic}}</td>
        <td><b>{{$camera->camera_name}} </b> 
        <br>
        {{$camera->history_des}}</td>
        <td>{{$camera->work_des}}</td>
      </tr>

    @endif
    @endif
    @endif

          </td>
                </tr>
    @endforeach
    @endif

</div>

    </tbody>  
  </table>


















@endsection