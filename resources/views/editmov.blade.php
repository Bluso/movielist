@extends('layouts.admin')

@section('content')
    <div class="container">
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Movies Form</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="/home">Home</a></li>
                  <li class="breadcrumb-item"><a href="/movies">Movies List</a></li>
                  <li class="breadcrumb-item active">Movies Form</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-10">
                <div class="card card-success">
                  <div class="card-header">
                    <h3 class="card-title">Edit a movie</h3>
                  </div>
                  {!! Form::open(['action' => ['MoviesController@update', $movies->id], 'method' => 'POST']) !!}
                  <div class="card-body">
                      <div class="form-group">
                        <div class="col-sm-10">
                          {{Form::label('id', 'ID')}}
                          {{Form::text('id', $movies->id, ['class' => 'form-control', 'placeholder' => 'id'])}}
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-10">
                          {{Form::label('name', 'Name')}}
                          {{Form::text('name', $movies->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-10">
                          {{Form::label('mov-time', 'Movie time (mins) *integer number')}}
                          {{Form::text('mov-time', $movies->mov_time, ['class' => 'form-control', 'placeholder' => 'Movie Time'])}}
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-10">
                          {{Form::label('description', 'Description')}}
                          {{Form::text('description', $movies->description, ['class' => 'form-control', 'placeholder' => 'Description'])}}
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-10">
                          {{Form::label('category', 'Category')}}
                          {{Form::text('category', $movies->category, ['class' => 'form-control', 'placeholder' => 'Category'])}}
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-10">
                          {{Form::label('img', 'Image *.jpg or .png file')}}
                          {{Form::text('img', '', ['class' => 'form-control', 'placeholder' => 'Image'])}}
                        </div>
                      </div>
                      {{Form::hidden('_method','PUT')}}
                      {!! Form::close() !!}
                      <button type="button" class="btn btn-success btn-block" onclick="document.getElementById('inputFile').click()">Add Image</button>
                      <div class="form-group inputDnD">
                        <label class="sr-only" for="inputFile">File Upload</label>
                        <input type="file" class="form-control-file text-primary font-weight-bold" id="inputFile" accept="image/*" onchange="readUrl(this)" data-title="Drag & Drop files here">
                      </div>
                      <input type="submit" class="btn btn-success" value="Save">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
    </div>

    <script>
      function readUrl(input) {
        if (input.files && input.files[0]) {
          if (input.files[0].type == 'image/jpeg' || input.files[0].type == 'image/png') {
            let reader = new FileReader();
            reader.onload = (e) => {
              let imgData = e.target.result;
              let imgName = input.files[0].name;
              input.setAttribute("data-title", imgName);
              console.log(e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
          } else {
            alert("Please choose '.jpg, .png' type of file");
          }
        }
      }
    </script>
@endsection
