@extends('layouts.admin')
@section('content')

@push('head')
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Issue Books</title>
  {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> --}}
  <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
  {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> --}}
  <link rel="stylesheet" href="{{ asset('css/v3.3.6/bootstrap.min.css') }}">
  {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
  --}}
  <script type="text/javascript" src="{{ asset('js/v3.3.6/bootstrap.min.js') }}"></script>

@endpush

<style type="text/css">
  .input-icon { 
    position: relative;
  }

  .input-icon > i {
    position: absolute;
    display: block;
    transform: translate(0, -50%);
    top: 50%;
    pointer-events: none;
    width: 25px;
    text-align: center;
    font-style: normal;
  }

  .input-icon > input {
    padding-left: 25px;
    padding-right: 0;
  }

  .input-icon-right > i {
    right: 0;
  }

  .input-icon-right > input {
    padding-left: 0;
    padding-right: 25px;
    text-align: right;
  }

</style>

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add Books</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('books.index') }}">Books</a></li>
              <li class="breadcrumb-item active">Add Books</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
    	<div class="container">
        <div class="col-md-10">
               
    <div class="card border-dark mb-3">
       @if(session()->get('success'))
          <div class="alert alert-success">
              {{ session()->get('success') }}
          </div>
       @endif
       @if(session()->get('error'))
         <div class="alert alert-danger">
             {{ session()->get('error') }}
         </div>
       @endif
        <div class="card-header bg-primary"><h5>Lehkhabu thar dahluhna</h5></div>
          <div class="card-body text-dark">
            <form method="post" action="{{ route('books.store') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <div class="form-group">
                  <label>Title<span class="text-danger"> *</span></label>
                  <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" placeholder="Title" autocomplete="off" value="{{ old('title') }}" autofocus required>
                  @if ($errors->has('title'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('title') }}</strong>
                  </span>
                  @endif
              </div>

              <div class="form-group">
                <label for="dropdown">Author <span class="text-danger"> *</span></label>
                
                <div class="row">
                  <div class="col-6">
                      <select data-skip-name="true" class="form-control chzn-select" data-placeholder="Search author here" id="dropdown" onchange="handleDropdownChange(this)" name="author" required>
                        <option value=""></option>
                          @foreach($authors as $author)
                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                          @endforeach
                      </select>
                  </div>

                  <div class="col-6">
                      <input class="form-control" type="text" id="textbox" oninput="handleTextInput(this)" name="author" value="" placeholder="Enter new author here..." required>
                  </div>
                </div>
              </div>

              <div class="form-group">
                  <label>Edition</label>
                  <input type="text" class="form-control" name="edition" placeholder="Edition" value="{{ old('edition') }}">
                  <div class="clearfix"></div>
              </div>

              <div class="form-group">
                  <label>Volume</label>
                  <input type="text" class="form-control" name="volume" placeholder="Volume" value="{{ old('volume') }}">
                  <div class="clearfix"></div>
              </div>

              <div class="form-group">
                  <label>Year <span class="text-danger"> *</span></label>
                  <input type="number" class="form-control" name="year" placeholder="Year" maxlength="4" minlength="4" value="{{ old('year') }}" required>
                  <div class="clearfix"></div>
              </div>

              <!-- <div class="form-group">
                  <label>Publishers</label>
                  <input type="text" class="form-control" name="publisher" placeholder="Publishers" value="{{ old('publisher') }}" required>
                  <div class="clearfix"></div>
              </div> -->

              <div class="form-group">
                <label for="dropdown">Publishers <span class="text-danger"> *</span></label>
                
                <div class="row">
                  <div class="col-6">
                      <select data-skip-name="true" class="form-control chzn-select" data-placeholder="Search publisher here" id="dropdown1" onchange="publisherDropdownChange(this)" name="publisher" required>
                        <option value=""></option>
                          @foreach($publishers as $publisher)
                            <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                          @endforeach
                      </select>
                  </div>

                  <div class="col-6">
                      <input class="form-control" type="text" id="textbox1" oninput="publisherTextInput(this)" name="publisher" value="" placeholder="Enter new publisher here..." required>
                  </div>
                </div>
              </div>

              <div class="form-group">
                  <label>Pages <span class="text-danger"> *</span></label>
                  <input type="number" class="form-control" name="pages" placeholder="Pages" value="{{ old('pages') }}" required>
                  <div class="clearfix"></div>
              </div>

              <div class="form-group">
                  <label>Accession No <span class="text-danger"> *</span></label>
                  <input type="text" class="form-control" name="accession" placeholder="Accession No" value="{{ old('accession') }}"  required>
                  <div class="clearfix"></div>
              </div>

              <div class="form-group">
                  <label>Classification No</label>
                  <input type="text" class="form-control" name="classification" placeholder="Classification No" value="{{ old('classification') }}">
                  <div class="clearfix"></div>
              </div>

              <div class="form-group">
                  <label>Subject</label>
                  <input type="text" class="form-control" name="subject" placeholder="Subject" value="{{ old('subject') }}">
                  <div class="clearfix"></div>
              </div>

              <div class="form-group">
                  <label>Book No</label>
                  <input type="text" class="form-control" name="bookno" placeholder="Book No" value="{{ old('bookno') }}">
                  <div class="clearfix"></div>
              </div>

              <div class="form-group">
                  <label>Source <span class="text-danger"> *</span></label>
                  <textarea class="form-control" name="description" rows="2" placeholder="Source" required>{{ old('description') }}</textarea>
              </div>

              <div class="form-group">
                  <label>Price <span class="text-danger"> *</span></label>
                  
                  <div class="input-icon">
                  <input type="number" class="form-control" name="price" placeholder="0.00" pattern="^[0-9]+(\.[0-9]{1,2})?$" min="0" value="{{ old('price') }}" required><i>&#8377;</i></div>
                  <div class="clearfix"></div>
              </div>

              
              <div class="form-group">
                  <label>Location</label>
                  <input type="text" class="form-control" name="location" placeholder="Location" value="{{ old('location') }}">
                  <div class="clearfix"></div>
              </div>

              <div class="form-group">
                  <label>Number of Copies <span class="text-danger"> *</span></label>
                  <input type="number" class="form-control" name="nos" placeholder="Number of Copies" value="{{ old('nos') ?? 1 }}" min="1" style="width: 100px;">
                  <div class="clearfix"></div>
              </div>
      </div>
              <div class="card-footer">
                  <div class="form-group">
                  <label></label>    
                  <input type="submit" class="btn btn-primary" value="Submit">
                  <a id="printPageButton" href="{{ Route('books.index') }}" class="btn btn-secondary" title="Generate Barcode"><i class="fas fa-back"></i> Back </a>
                  </div>
              </div>
            </form>
      </div>               
          </div>
    	</div>

</section>

<script>

    function handleDropdownChange(dropdown) {
      var textbox = document.getElementById('textbox');

      if (dropdown.value === "") {
        // If the first option is selected, make the textbox editable
        textbox.disabled = false;
        textbox.required = true;
      } else {
        // If any other option is selected, make the textbox readonly
        textbox.disabled = true;
        textbox.required = false;
      }
    }

    function handleTextInput(textbox) {
      var dropdown = document.getElementById('dropdown');

      if (textbox.value !== "") {
        // If text is entered, disable the dropdown
        dropdown.disabled = true;
        dropdown.required = false;
        $("#dropdown").prop("disabled", true).trigger("chosen:updated");
      } else {
        // If text is deleted, enable the dropdown
        dropdown.disabled = false;
        dropdown.required = true;
        $("#dropdown").prop("disabled", false).trigger("chosen:updated");
      }
    }


    function publisherDropdownChange(dropdown1) {
      var textbox = document.getElementById('textbox1');

      if (dropdown1.value === "") {
        // If the first option is selected, make the textbox editable
        textbox.disabled = false;
        textbox.required = true;
      } else {
        // If any other option is selected, make the textbox readonly
        textbox.disabled = true;
        textbox.required = false;
      }
    }

    function publisherTextInput(textbox1) {
      var dropdown = document.getElementById('dropdown1');

      if (textbox1.value !== "") {
        // If text is entered, disable the dropdown
        dropdown.disabled = true;
        dropdown.required = false;
        $("#dropdown1").prop("disabled", true).trigger("chosen:updated");
      } else {
        // If text is deleted, enable the dropdown
        dropdown.disabled = false;
        dropdown.required = true;
        $("#dropdown1").prop("disabled", false).trigger("chosen:updated");
      }
    }
</script>

<script>

$(document).ready(function(){

     $("select").chosen({allow_single_deselect:true});

});

</script>

@endsection