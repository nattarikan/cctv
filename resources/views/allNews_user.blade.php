@extends('layoutuser')

@section('title','Home')

@section('content')


<br><br>
<body>


	
<br>	
<div class="container">
	<!-- <a class="btn btn-primary" href="{{url('user/home/create')}}"><i class="fa fa-paint-brush"> </i> Create</a><br><br> -->
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
					<td><i class="fa fa-commenting"> </i>  {{$row->news_title}}</td>
					<!-- <td>{{$row->n_content}}</td> -->
					<!-- <td><img class="img-responsive" src="{{asset($row->n_img)}}" width="50" height="50"></td> -->
				 	<td>{{$row->news_date}}</td>
					<!-- <td>{{$row->updated_at}}</td> -->
					<td>
						<!-- <a class="fl btn btn-primary" id="edit" href="{{url('user/home/'.$row->news_id.'/edit') }}">EDIT</a> -->
						<!-- <form action="{{url('user/home/'.$row->news_id) }}" method="post" onsubmit="return(confirm('Do you want to delete ?'))">
						{{ method_field('DELETE') }}
						{{ csrf_field() }}
						<button type="submit" class="btn btn-danger">DELETE</button>
						</form> -->
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