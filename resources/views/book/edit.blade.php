@extends('layouts.admin')
@section('content')
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
            <h1 class="m-0 text-dark">Edit Books</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('books.index') }}">Books</a></li>
              <li class="breadcrumb-item active">Edit Books</li>
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
        <div class="card-header bg-info"><h5>Edit book details</h5></div>
          <div class="card-body text-dark">
            <form method="post" action="{{ route('books.update',$book->id) }}">
                @method('PUT')
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <div class="form-group">
                  <label>Title</label>
                    
                      <input type="text" class="form-control" name="title" value="{{ $book->title }}" required>
                     
              </div>

              <div class="form-group">
                  <label>Author</label>
                   
                      {{-- <input type="text" class="form-control" name="author" value="{{ $book->author->id }}"> --}}

                      
                      <select data-skip-name="true" id="dropdown" class="form-control chzn-select" data-placeholder="Search author here" name="author">
                        <option value="{{ $book->author->id }}" selected>{{ $book->author->name }}</option>
                        <option class="text-bold" disabled>-Select author from below-</option>
                          @foreach($authors as $author)
                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                          @endforeach
                      </select>
                 
                   
              </div>

              <div class="form-group">
                  <label>Edition</label>
                   
                      <input type="text" class="form-control" name="edition" value="{{ $book->edition }}">
                   
              </div>

              <div class="form-group">
                  <label>Volume</label>
                   
                      <input type="text" class="form-control" name="volume" value="{{ $book->volume }}">
                   
              </div>

              <div class="form-group">
                  <label>Year</label>
                   
                      <input type="text" class="form-control" name="year" value="{{ $book->year }}" required>
                   
              </div>

              <div class="form-group">
                  <label>Publishers</label>
                   
                      {{-- <input type="text" class="form-control" name="publisher" value="{{ $book->publisher }}"> --}}

                      
                      <select data-skip-name="true" class="form-control chzn-select" data-placeholder="Search publisher here" name="publisher">
                        <option value="{{ $book->publisher->id }}" selected>{{ $book->publisher->name }}</option>
                        <option class="text-bold" disabled>-Select publisher from below-</option>

                          @foreach($publishers as $publisher)
                            <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                          @endforeach
                      </select>
                  
                   
              </div>

              <div class="form-group">
                  <label>Pages</label>
                   
                      <input type="number" class="form-control" name="pages" value="{{ $book->pages }}" required>
                   
              </div>

              <div class="form-group">
                  <label>Accession No</label>
                   
                      <input type="text" class="form-control" name="accession" value="{{ $book->accessionno }}" required>
                   
              </div>

              <!-- <div class="form-group">
                  <label>Classification No</label>
                   
                      <input type="text" class="form-control" name="classification" value="{{ $book->classificationno }}" required>
                   
              </div> -->

              <!-- <div class="form-group">
                  <label>Subject</label>
                   
                      <input type="text" class="form-control" name="subject" value="{{ $book->subject }}" required>
                   
              </div> -->

              <!-- <div class="form-group">
                  <label>Book No</label>
                   
                      <input type="text" class="form-control" name="bookno" value="{{ $book->bookno }}">
                   
              </div> --> 

              <div class="form-group">
                  <label>Source</label>
                    
                      <textarea class="form-control" name="description" rows="2" required>{{ $book->description }}</textarea>
                   
              </div>


              <div class="form-group">
                  <label>Price</label>
                    <div class="input-icon">
                      <input type="number" class="form-control" name="price" value="{{ $book->price }}" placeholder="0.00" required><i>&#8377;</i>
                    </div>
              </div>

              <div class="form-group">
                  <label>Location</label>
                   
                      <input type="text" class="form-control" name="location" value="{{ $book->location }}">
                   
              </div>


        </div>
              <div class="card-footer">
                  <div class="form-group">
                  <label></label>    
                  <input type="submit" class="btn btn-info" value="Update">
                  <a id="printPageButton" href="{{ Route('books.index') }}" class="btn btn-secondary" title="Generate Barcode"><i class="fas fa-back"></i> Back </a>
                  </div>
              </div>
      </div>               
            </form>
          </div>
    	</div>
</section>

<script>

$(document).ready(function(){

     $("select").chosen({allow_single_deselect:true});

});

$("#dropdown").trigger("chosen:updated");

</script>
@endsection