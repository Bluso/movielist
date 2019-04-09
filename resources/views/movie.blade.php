@extends('layouts.admin')

@section('content')
  <div id="page-movie">
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Movies List</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="col-sm-10">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Mov_time(mins)</th>
              <th>Description</th>
              <th>Category</th>
              <th>Image</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
            </thead>

            @if(count($movies) > 0)
              @foreach($movies as $movie)
                <tbody>
                  <tr>
                    <td>{{$movie->id}}</td>
                    <td>{{$movie->name}}</td>
                    <td style="text-align:center">{{$movie->mov_time}}</td>
                    <td>{{$movie->description}}</td>
                    <td>{{$movie->category}}</td>
                    <td>{{$movie->img}}</td>
                    <td><a href="{{action('MoviesController@edit', $movie->id)}}" class="btn btn-success">Edit</a></td>
                    <!-- <td><a href="{{action('MoviesController@destroy', $movie->id)}}" class="btn btn-danger">x</a></td> -->
                    <td>
                        {!!Form::open(['action' => ['MoviesController@destroy', $movie->id], 'method' => 'POST', 'class' => 'delete'])!!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('x', ['class' => 'btn btn-danger'])}}
                        {!!Form::close()!!}
                    </td>
                  </tr>
                </tbody>
              @endforeach
            @else
              <p>No movies found</p>
            @endif
            <tfoot>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Mov_time(mins)</th>
                <th>Description</th>
                <th>Category</th>
                <th>Image</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </tfoot>
          </table>
            {{$movies->links()}}
            <a href="/modifymov/" class="btn btn-primary">Add a movie</a><br /><br />
            <button id="edit-btn" type="button" class="btn btn-success" name="edit-btn" data-id="20" >Edit</button>
            <button id="delete-btn" type="button" class="btn btn-danger" name="delete-btn" data-id="30" >Delete</button>
          </div>
        <!-- /.card-body -->
        </div>
      </div>
      </div>
@endsection
