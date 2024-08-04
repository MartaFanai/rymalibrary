@extends('layouts.admin')
@section('content')
@push('head')
  {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> --}}
  {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> --}}
  {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}

  <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('css/v3.3.6/bootstrap.min.css') }}">
  <script type="text/javascript" src="{{ asset('js/v3.3.6/bootstrap.min.js') }}"></script>
@endpush

<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Return Books</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item">Return Home</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container">
        <div class="col-md-12">
      <div class="card border-dark mb-3">
        <div class="card-header bg-warning">
            <div style="display: inline-block;">
              <h5>Return Using Book (Borrowed)</h5> 
            </div>
            <div style="display: inline-block;">
              &nbsp; &nbsp; <a class="btn btn-danger" href="{{ route('return') }}">Return Using Member</a>
            </div>
        </div>
    
    <div class="panel-body mt-5">
     <div class="panel panel-default">
          <div class="form-control">
            <div class="input-group">
              <input type="text" name="search" id="search" class="form-control" placeholder="Search book title, accession no" autocomplete="off" autofocus>
              <div class="input-group-append">
                <button class="btn btn-secondary" type="button">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div>
          </div>
     <div class="table-responsive mt-4">
      <h5 align="center">Total Borrowed Book Found : <span id="total_records"></span></h5>
      <table class="table table-striped table-bordered mt-4">
       <thead>
        <tr>
         <th>Title</th>
         <th>Accession No</th>
         <th>Location</th>
         <th>Action</th>
        </tr>
       </thead>
       <tbody>

       </tbody>
      </table>
     </div>
    </div>    
   </div>
  </div>
</div>
</div>

</section>

 
<script>
$(document).ready(function(){

 fetch_customer_data();

 function fetch_customer_data(query = '')
 {
  $.ajax({
   url:"{{ route('retSearch1') }}",
   method:'GET',
   data:{query:query},
   dataType:'json',
   success:function(data)
   {
    $('tbody').html(data.table_data);
    $('#total_records').text(data.total_data);
   }
  })
 }

 $(document).on('keyup', '#search', function(){
  var query = $(this).val();
  fetch_customer_data(query);
 });
});
</script>
@endsection