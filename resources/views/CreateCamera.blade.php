@extends('layouts.layoutadmin')

@section('content')
<div class="container">
  <div class='row'>

<form action="{{ $url }}" method="POST" enctype="multipart/form-data" >

  {{ method_field($method) }}

  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">




  <div class="form-group">
    <label for="camera_server">Server</label>
    <select class="form-control css-require" name="server" placeholder="Server" >

        <option value="">Please Select</option>
        <option value="3">Server 3</option>
        <option value="4">Server 4</option>
        <option value="5">Server 5</option>
        <option value="7">Server 7</option>
        <option value="8">Server 8</option>
        <option value="9">Server 9</option>
        <option value="10">Server 10</option>
        

      </select>

  </div>


  <div class="form-group">
    <label for="camera_name">Name</label>
    <input type="text" class="form-control" name="name" placeholder="Name" >
  </div>

  <div class="form-group">
    <label for="camera_ip">Ip Address</label>
    <input type="text" class="form-control" name="ip" placeholder="Ip" >
  </div>

  <!-- <div class="form-group">
    <label for="camera_brand">Brand</label>
    <input type="text" class="form-control" name="brand" placeholder="Brand" >
  </div> -->

  <div class="form-group">
    <label for="camera_brand">Brand</label>
    <select class="form-control css-require" name="brand" placeholder="Brand" >

        <option value="">Please Select</option>
        <option value="HIKVISION">HIKVISION</option>
        <option value="INNEKT">INNEKT</option>
        <option value="Bosch">Bosch</option>
        <option value="ACTI">ACTI</option>
        <option value="AXIS">AXIS</option>
        <option value="Dinion NER-L2">Dinion NER-L2</option>
        <option value="Honeywell">Honeywell</option>
        

      </select>

  </div>


  <button type="submit" class="btn btn-primary">Submit</button>
</form>

  </div>
</div>


<br>

<script>
  
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});



</script>
@endsection