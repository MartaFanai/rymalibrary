@extends('layouts.admin')
@section('content')

<link rel="stylesheet" href="{{ asset('plugins/rateyo/jquery.rateyo.min.css') }}">

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Author</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('authors.index') }}">Author</a></li>
              <li class="breadcrumb-item active">Edit Author</li>
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
         
           
              
        <div class="card-header bg-info">
            <div class="row">
                <div class="col-md-6">
                    <h5>Edit Author details</h5>
                </div>
            </div>
        </div>
        
          <div class="card-body text-dark">
            <form method="post" action="{{ route('authors.update',$authors->id) }}">
                
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

             <div class="form-group">
                  <label>Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $authors->name }}" required>
             </div>

           </div>

            <div class="card-footer">
                  <div class="form-group">
                     <input type="submit" class="btn btn-info" value="Update">
                     <a id="printPageButton" href="{{ Route('authors.index') }}" class="btn btn-secondary" title="Generate Barcode"><i class="fas fa-back"></i> Back </a>
                     
                  </div>  
            </div> 

         </form>
      </div>
    </div>
</section>

@endsection