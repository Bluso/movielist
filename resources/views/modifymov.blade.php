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
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Add a movie</h3>
                </div>
                {!! Form::open(['action' => 'MoviesController@store', 'method' => 'POST']) !!}
                <div class="card-body">
                  <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                    <div class="col-sm-10">
                      {{Form::label('id', 'ID', ['class' => 'control-label'])}}
                      {{Form::text('id', '', ['class' => 'form-control', 'placeholder' => 'id'])}}
                      @if ($errors->has('id'))
                        <span class="help-block">* ID is required</span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <div class="col-sm-10">
                      {{Form::label('name', 'Name')}}
                      {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
                      @if ($errors->has('name'))
                        <span class="help-block">* Name is required</span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group{{ $errors->has('mov-time') ? ' has-error' : '' }}">
                    <div class="col-sm-10">
                      {{Form::label('mov-time', 'Movie time (mins) *integer number')}}
                      {{Form::text('mov-time', '', ['class' => 'form-control', 'placeholder' => 'Movie Time'])}}
                      @if ($errors->has('mov-time'))
                        <span class="help-block">* Movie time is required</span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <div class="col-sm-10">
                      {{Form::label('description', 'Description')}}
                      {{Form::text('description', '', ['class' => 'form-control', 'placeholder' => 'Description'])}}
                      @if ($errors->has('description'))
                        <span class="help-block">* Description is required</span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                    <div class="col-sm-10">
                      {{Form::label('category', 'Category')}}
                      {{Form::text('category', '', ['class' => 'form-control', 'placeholder' => 'Category'])}}
                      @if ($errors->has('category'))
                        <span class="help-block">* Category is required</span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group{{ $errors->has('img') ? ' has-error' : '' }}">
                    <div class="col-sm-10">
                      {{Form::label('img', 'Image *.jpg or .png file')}}
                      <!-- {{Form::text('img', '', ['class' => 'form-control', 'placeholder' => 'Image'])}} -->
                    </div>
                  </div>
                  <!-- <div class="form-group">
                    <div class="col-sm-10">
                      <div class="file-loading">
                          {{Form::file('input-image', ['class' => 'file-loading', 'id' => 'input-image-3'])}}
                      </div>
                    </div>
                  </div> -->
                  <!-- {{Form::submit('Save', ['class' => 'btn btn-primary'])}} -->
                  {!! Form::close() !!}
                  <!-- <button type="button" class="btn btn-primary btn-block" onclick="document.getElementById('inputFile').click()">Add Image</button> -->
                  <!-- <div class="form-group inputDnD">
                    <label class="sr-only" for="inputFile">File Upload</label>
                    <input type="file" class="form-control-file text-primary font-weight-bold" id="inputFile" accept="image/*" onchange="readUrl(this)" data-title="Drag & Drop files here">
                  </div> -->
                  <form class="form-upload" method="post" enctype="multipart/form-data">
                    <div id="drop-area">
                          <p>Drop file here or</p>
                          <input type="file" id="file-input" multiple accept="image/*" onchange="handleFiles(this.files)">
                          <label class="select-btn btn btn-primary" for="file-input">Select file</label>
                          <input type="hidden" name="_token" value="{{ csrf_token() }}" /><br>
                       <!-- <progress id="progress-bar" max=100 value=0></progress> -->
                      <div id="preview"></div>
                    </div>
                  </form>
                  <input type="submit" class="btn btn-primary" value="Save">
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <script>
      // function readUrl(input) {
      //   if (input.files && input.files[0]) {
      //     if (input.files[0].type == 'image/jpeg' || input.files[0].type == 'image/png') {
      //       let reader = new FileReader();
      //       reader.onload = (e) => {
      //         let imgData = e.target.result;
      //         let imgName = input.files[0].name;
      //         input.setAttribute("data-title", imgName);
      //       }
      //       reader.readAsDataURL(input.files[0]);
      //       console.log(input.files[0]);
      //     } else {
      //       alert("Please choose '.jpg, .png' type of file");
      //     }
      //   }
      // }
      // ************************ Drag and drop ***************** //
      let dropArea = document.getElementById("drop-area")

      // Prevent default drag behaviors
      ;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false)
        document.body.addEventListener(eventName, preventDefaults, false)
      })

      // Highlight drop area when item is dragged over it
      ;['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, highlight, false)
      })

      ;['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, unhighlight, false)
      })

      // Handle dropped files
      dropArea.addEventListener('drop', handleDrop, false)

      function preventDefaults (e) {
        e.preventDefault()
        e.stopPropagation()
      }

      function highlight(e) {
        dropArea.classList.add('highlight')
      }

      function unhighlight(e) {
        dropArea.classList.remove('active')
      }

      function handleDrop(e) {
        var dt = e.dataTransfer
        var files = dt.files

        handleFiles(files)
      }

      function handleFiles(files) {
        if (files[0].type == 'image/jpeg' || files[0].type == 'image/png') {
          files = [...files]
          files.forEach(previewFile)
        } else {
          alert("Please choose '.jpg, .png' type of file");
        }
      }

      function previewFile(file) {
        let reader = new FileReader()
        reader.readAsDataURL(file);
        reader.onloadend = function() {
          let img = document.createElement('img');
          img.src = reader.result;
          document.getElementById('preview').appendChild(img);
        }
      }

    </script>

@endsection
