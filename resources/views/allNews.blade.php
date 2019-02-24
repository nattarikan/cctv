@extends('layoutadmin')

@section('title','Home')

@section('content')


<br><br>
<body>

	<div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-futbol-o w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>                     </h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Sports</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-newspaper-o w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>                  </h3>
        </div>
        <div class="w3-clear"></div>
        <h4>News</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-briefcase w3-xxxlarge"></i></div>
        <div class="w3-right">
      <h3>                                         </h3>


        </div>
        <div class="w3-clear"></div>
        <h4>Borrow</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>                                       </h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Users</h4>
      </div>
    </div>
  </div>
	
<br>	
<div class="container">
	<a class="btn btn-primary" href="{{url('admin/home/create')}}"><i class="fa fa-paint-brush"> </i> Create</a><br><br>
		<div class="table-responsive">          
		<table class="table">
			<thead>
				<tr>
					<th>Title</th>
					<!-- <th>Content</th> -->	
					<!-- <th>Image</th>	 -->			
					<th>Create</th>
					<!-- <th>Update</th> -->
				</tr>
			</thead>

			@foreach($objs as $row)
			<tbody>
				<tr>
					<td><i class="fa fa-comments"> </i>  {{$row->news_title}}</td>
					<!-- <td>{{$row->n_content}}</td> -->
					<!-- <td><img class="img-responsive" src="{{asset($row->n_img)}}" width="50" height="50"></td> -->
				 	<td>{{$row->news_date}}</td>
					<!-- <td>{{$row->updated_at}}</td> -->
					<td>
						<a class="fl btn btn-primary" id="edit" href="{{url('admin/home/'.$row->news_id.'/edit') }}">EDIT</a>
						<form action="{{url('admin/home/'.$row->news_id) }}" method="post" onsubmit="return(confirm('Do you want to delete ?'))">
						{{ method_field('DELETE') }}
						{{ csrf_field() }}
						<button type="submit" class="btn btn-danger">DELETE</button>
						</form>
					</td>
				</tr>
			</tbody>
			@endforeach
		</table>

    


		</div>

    <h6 class="w3-text-grey"> Total all news : {{$objs->count()}}/{{ $objs->total() }} </h6>
</div>



<center>
    {{ $objs->render() }}
</center>


</body>
@stop