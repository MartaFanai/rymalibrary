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

<script type="text/javascript">
       
    function formToSubmit(userId) 
    {
        $('#submitForm' + userId).submit();
    }
        
</script>

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">User List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ '/home' }}">Dashboard</a></li>
              <li class="breadcrumb-item active">User List</li>
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
    				<th width="5%">#</th>
    				<th width="35%">Name</th> 
                    <th width="35%">Administrator Privilege</th>
    			</tr>
            </thead>
            <tbody>
                @if(count($user))
    			@foreach($user as $r)
    			<tr>
    				<td>{{$i++}}</td>
    				<td>{{$r->name}}</td>
                    <td>
                        <form id="submitForm{{ $r->id }}" method="POST" action="{{ route('settings.update.user', $r->id) }}">
                                @csrf
                            <input type="hidden" name="id" value="{{ $r->id }}">
                            <div class="form-check form-switch">
                                <input class="form-check-input ml-5" type="checkbox" name="admin" {{ $r->role === 0 ? 'checked' : '' }} onclick="formToSubmit('{{ $r->id }}')" style="transform: scale(1.6);" {{ $r->id === Auth::user()->id ? 'disabled' : '' }} />
                            </div>
                        </form>
                    </td>
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