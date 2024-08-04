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
            <h1 class="m-0 text-dark">Transaction Report of {{$member->name}} (Not Return)</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ '/home' }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ '/members' }}">Members</a></li>
              <li class="breadcrumb-item active">Not Return</li>
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
                <td><a href="{{ route('record', $member->id) }}" class="btn btn-success">All Returned Transaction</a></td>
                <td><a href="{{ route('notReturn', $member->id) }}" class="btn btn-secondary disabled">Not Returned Transaction</a></td>
                <td><a href="{{ Route('members.index') }}" class="btn btn-secondary"><i class="fas fa-back"></i> Back </a></td>
                </tr>
                </table>
    		</p>
            <?php $i = 1; ?>
    		<table class="table table-bordered table-striped table-hover" id="example1">
            <thead>
    			<tr>
    				<th>#</th>
    				<th>Book Title</th>
    				<th>Date of Lending</th>
    				<th>Last Date of Return</th>
    				<th>Issue Auth</th>
    			</tr>
            </thead>
            <tbody>
                @if(count($report))
    			@foreach($report as $r)
    			<tr>
    				<td>{{$i++}}</td>
    				<td>{{$r->book->title}}</td>
    				<td>{{\Carbon\Carbon::parse($r->issueDate)->format('d-M-Y') }}</td>
                    <td>{{\Carbon\Carbon::parse($r->retDate)->format('d-M-Y') }}</td>
    				<td>{{$r->users_name}}</td>
    				
    			</tr>
                @endforeach
                 @else
                <tr><td colspan="8"><h4>All books were retuned.</h4></td></tr>
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