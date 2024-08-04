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
            <h1 class="m-0 text-dark">Books Issue & Return Report (Returned)</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ '/home' }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Books Issue & Return Report</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
    	<div class="container-fluid">

            <p>
                <table>
                <tr>
                <td><a href="{{ route('report') }}" class="btn btn-secondary disabled">All Returned Transaction</a></td>
                <td><a href="{{ route('retreport', 1) }}" class="btn btn-primary">Not Returned Transaction</a></td>
                </tr>
                </table>
            </p>
    		
    		<table class="table table-bordered table-striped table-hover" id="example1">
            <thead>
    			<tr>
    				<th>#</th>
    				<th>Title</th>
    				<th>Borrower</th>
    				<th>Isssue Date</th>
    				<th>Issue Auth</th>
                    <th>Return Date</th>
    				<th>Return Auth</th>
    			</tr>
            </thead>
            <tbody>
                @if(count($report))
                <?php $i = 1; ?>
    			@foreach($report as $m)
    			<tr>
    				<td>{{$i++}}</td>
                    <td>{{$m->book->title}} ({{$m->book->accessionno}})</td>
                    <td>{{$m->member->name}}</td>
                    <td>{{\Carbon\Carbon::parse($m->issueDate)->format('d-M-Y') }}</td>
                    <td>{{$m->issue_users}}</td>
                    <td>{{\Carbon\Carbon::parse($m->retDate)->format('d-M-Y') }}</td>
                    <td>{{$m->return_users}}</td>
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