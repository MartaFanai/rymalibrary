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
            <h1 class="m-0 text-dark">Generate ID</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ '/home' }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Generate ID</li>
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
    				<th>Fathers Name</th>
    				<th>Mothers Name</th>
    				<th>Section</th>
    				<th>Address</th>
                    <th>Action</th>
    			</tr>
            </thead>
            <tbody> <?php $i = 1; ?>
                @if(count($generateid))
    			@foreach($generateid as $g)
    			<tr>
    				<td>{{$i++}}</td>
    				<td>{{$g->name}}</td>
    				<td>{{$g->fname}}</td>
    				<td>{{$g->mname}}</td>
    				<td>{{$g->section}}</td>
                    <td>{{$g->address}}</td>
    				<td><a href="{{ route('generateidmember', $g->id) }}" class="btn btn-warning"><i class="fas fa-code-branch"></i></a> 
                        
                    </td>
    			</tr>
                @endforeach
                 @else
                <tr><td colspan="7"><h4>No members found.</h4></td></tr>
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