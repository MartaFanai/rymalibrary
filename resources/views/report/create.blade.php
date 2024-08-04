@extends('layouts.admin')
@section('content')

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
        <div class="card-header bg-primary"><h5>Lahkhabu thar dahluhna</h5></div>
          <div class="card-body text-dark">
            <form method="post" action="{{ route('books.store') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <div class="form-group">
                  <label>Title</label>
                  <input type="text" class="form-control" name="title" placeholder="Title" autocomplete="off">
              </div>
              

              <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" name="description" rows="2" placeholder="Description"></textarea>
              </div>


              <div class="form-group">
                  <label>Book Code</label>
                  <input type="text" class="form-control" name="bcode" placeholder="Book Code">
              </div>

              <div class="form-group">
                  <label>Author</label>
                  <input type="text" class="form-control" name="author" placeholder="Author">
                  <div class="clearfix"></div>
              </div>
      </div>
              <div class="card-footer">
                  <div class="form-group">
                  <label></label>    
                  <input type="submit" class="btn btn-primary" value="Submit">
                  </div>
              </div>
      </div>               
            </form>
          </div>
    	</div>
    </section>

@endsection