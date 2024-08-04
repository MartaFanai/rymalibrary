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
            <h1 class="m-0 text-dark">Yearly Report Register</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ '/home' }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Yearly Report Register</li>
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
    				<th>Year</th>
    				<th>Total Issue</th>
    				<th>Total Return</th>
    				<th>Total Books</th>
                    <th>Updated On</th>
    			</tr>
            </thead>
            <tbody>
                @if(count($stat))
                <?php $i = 1; ?>
    			@foreach($stat as $s)
    			<tr>
    				<td>{{$i++}}</td>
                    <td>{{$s->year}}</td>
                    <td>{{$s->issue}}</td>
                    <td>{{$s->ret }}</td>
                    <td>{{$s->tot_book}}</td>
                    <td>{{\Carbon\Carbon::parse($s->updated_at)->format('d-M-Y') }}</td>
    			</tr>
                @endforeach
                 @else
                <tr><td colspan="8"><h4>No data found.</h4></td></tr>
                @endif
            </tbody>
    		</table>

            </div>
<!-- Modal -->

    	</div>
    </section>
    <script>
     
        $("#example1").dataTable();

        
   
    </script>

@endsection