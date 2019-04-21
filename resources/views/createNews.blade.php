@extends('layouts.layoutadmin')

@section('title','Create News')

@section('content')


<br><br>
<div class="container">
  <div class='row'>











<form action="{{ $url }}" method="POST" enctype="multipart/form-data" >

  {{ method_field($method) }}

  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">













  <div class="form-group">
    <label for="news_title">Title</label>
    <input type="text" class="form-control" name="title" placeholder="Please enter a title" 

    >
  </div>




  <div class="form-group">
    <label for="news_des">Content</label>
    <textarea class="form-control" name="content" placeholder="Please enter the content"  rows="3"></textarea>
  </div>




  <div class="form-group">
    <label for="news_pic">Image</label>
    <input type="file"  name="image"     >

  </div>  




  <button type="submit" class="btn btn-primary">Submit</button>
</form>

  </div>
</div>


<br>



@stop