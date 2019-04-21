<!-- Admin ดู ช่างรายงานความคืบหน้า -->

@extends('layouts.layoutadmin')

@section('title','รายงานความคืบหน้า')

@section('content')



<br><br> 
<div class="container">
  <h2>ตรวจสอบการทำงานของช่าง</h2>
  <div class='row'>
    

    

    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

    <br><br>

  
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
          @endforeach

          </tbody>  
        </table>   
      </div>
      @endif
  
  </div>
</div>
















@endsection