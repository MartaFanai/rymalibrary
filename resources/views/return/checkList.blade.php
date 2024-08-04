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
</style>


<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Receipt</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ '/home' }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Receipt List</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
    	<div class="container-fluid">
    		
    		<table class="table table-bordered table-striped table-hover" id="example1">
            <thead>
    			<tr>
    				<th>#</th>
    				<th>Name</th>
                    <th>ID Number</th>
    				<th>Receipt No</th>
    				<th>Book</th>
    				<th>No Of Days</th>
    				<th>Receipt Date</th>
                    
    			</tr>
            </thead>
            <?php $no =1; ?>
            <tbody>
                @if(count($receipt))
    			@foreach($receipt as $m)
    			<tr>
    				<td>{{$no++}}</td>
    				<td>{{$m->member->name}}</td>
                    <td>{{$m->member->id_number}}</td>
    				<td>{{$m->receiptNo}}</td>
    				<td>{{$m->book->title}}</td>
    				<td>{{$m->noOfDays}}</td>
                    <td>{{ \Carbon\Carbon::parse($m->billDate)->format('d/m/Y') }}</td> 
    				
    			</tr>
                @endforeach
                 @else
                <tr><td colspan="7"><h4>No receipt found.</h4></td></tr>
                @endif
            </tbody>
    		</table>

            </div>

    	</div>
    </section>


    <script>
    	$("#example1").dataTable();
    </script>

@endsection