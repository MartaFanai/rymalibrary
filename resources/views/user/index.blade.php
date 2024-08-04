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
            <h1 class="m-0 text-dark">Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ '/home' }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
    	<div class="container-fluid">
    		<p>
    			<a href="{{ route('users.create') }}" class="btn btn-primary">Add New User</a>
    		</p>
    		<table class="table table-bordered table-striped" id="example1">
                <thead>
        			<tr>
        				<th>#</th>
        				<th>User Name</th> 
        				<th>Email</th>
        				<th>Image</th>
                        <th>Action</th>
        			</tr>
                </thead>
                <tbody>
                @if(count($user))
                <?php 
                     
                        $sl=1; 
         
                ?>
    			@foreach($user as $u)
             
        			<tr>
        				<td>{{ $sl++ }}</td>
        				<td>{{$u->name}}</td>
        				<td>{{$u->email}}</td>
        				<td>
                            <div class="image">
                                <img src="{{ asset('storage/users/'.$u->image) }}" class="img-circle elevation-2" alt="User Image" style="width: 47px; border:1px solid #ccc;">
                            </div>
                        </td>
        				<td>
                            {{-- @if( Auth::user()->name != $u->name) --}}
                            <a href="{{ route('users.edit', $u->id) }}" class="btn btn-info"><i class="fas fa-edit"></i></a> 
                            <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                            {{-- @endif --}}
                        <form method="post" action="{{ route('users.destroy',$u->id) }}">
                            @method('DELETE')
                            <input type="hidden" name="_token" value=" {{ csrf_token() }}">
                           
                        </form>
                        </td>
        			</tr>
                    @endforeach
                     @else
                    <tr><td colspan="6"><h4>No Users found.</h4></td></tr>
                    @endif
                </tbody>
    		</table>

    	</div>
    </section>
    <script>
     
        $("#example1").dataTable();
   
    </script>

@endsection