@extends('layouts.admin')
@section('content')
<style type="text/css">
.dataTables_filter {
   float: right !important;
}

.dataTables_filter input { 
    width: 350px 
}

.dataTables_paginate {
  float: right !important;
}
i{
    color: white;
}
</style>

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Borrowed Book Records</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ '/home' }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Borrowed Book Records</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
    	<div class="container-fluid">
    		
            <?php $i = 1; ?>
    		<table class="table table-bordered table-striped table-hover" id="example1">
            <thead>
    			<tr>
    				<th>#</th>
    				<th width="35%">Book Title</th> 
                    <th width="35%">Author</th>
    				<th>Number Of Borrowings</th>
    			</tr>
            </thead>
            <tbody>
                @if(count($record))
    			@foreach($record as $r)
    			<tr>
    				<td>{{$i++}}</td>
    				<td>{{$r->title}}</td>
                    <td>{{$r->author->name}}</td>
                    <td>{{$r->borrow_count}}</td>
    			</tr>
                @endforeach
                 @else
                <tr><td colspan="8"><h4>No records found.</h4></td></tr>
                @endif
            </tbody>
    		</table>

            </div>

    	</div>
    </section>
  
    <script>
     
        $("#example1").dataTable({
            "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]],
        });
   
    </script>

@endsection