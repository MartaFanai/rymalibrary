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
<link rel="stylesheet" href="{{ asset('plugins/rateyo/jquery.rateyo.min.css') }}">



<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Deactivate Member</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ '/home' }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Deactivate Member</li>
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
    				<th>Name</th> 
                    <th>ID Number</th>
    				<th>Valid Till</th>
    				<th width="20%">Action</th>
    			</tr>
            </thead>
            <tbody>
                @if(count($members))
    			@foreach($members as $r)
    			<tr>
    				<td>{{$i++}}</td>
    				<td>{{$r->name}}</td>
                    <td>{{$r->id_number}}</td>
                    <td>{{ $r->year }}</td>
    				<td><a href="{{ route('deactivate.member', $r->id) }}" class="btn btn-danger"> Deactivate Membership </a></td>
    			</tr>
                @endforeach
                 @else
                <tr><td colspan="8"><h4>No inactive members found.</h4></td></tr>
                @endif
            </tbody>
    		</table>

            </div>

    	</div>
    </section>
  
    <script>
     
        $("#example1").dataTable();

        $(document).ready(function(){

        $('#myModal').on('show.bs.modal', function (e) {
            var id = $(e.relatedTarget).data('id');
            var url = "{{ route('members.destroy', ':id') }}";
            url = url.replace(':id', id);

            document.getElementById('deleteBtn').action = url;
        });

        
    });
   
    </script>

@endsection