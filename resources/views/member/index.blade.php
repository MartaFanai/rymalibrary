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
            <h1 class="m-0 text-dark">Members</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ '/home' }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Members</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
    	<div class="container-fluid">
    		<p>
    			<a href="{{ route('members.create') }}" class="btn btn-primary">Add New Member</a>
    		</p>
    		<table class="table table-bordered table-striped table-hover" id="example1">
            <thead>
    			<tr>
    				<th width="5%">#</th>
    				<th width="20%">Name</th>
    				<th width="20%">Family Relationship</th>
    				{{-- <th width="3%">Section</th> --}}
                    <th width="5%">Mobile</th>
    				<th width="20%">Address</th>
                    <th width="15%">ID Number</th>
                    <th width="15%">Action</th>
    			</tr>
            </thead>
            <tbody>
                @if(count($member))
                <?php $i = 1; ?>
    			@foreach($member as $m)
    			<tr>
    				<td>{{$i++}}</td>
    				<td>{{$m->name}}</td>
    				<td>{{ empty($m->relationname) ? 'N/A' : $m->relation.' '. $m->relationname }}</td>
    				{{-- <td>{{$m->section}}</td> --}}
                    <td>{{$m->mobile}}</td>
                    <td>{!! $m->address ? $m->address.'<br>'.$setting->id_address_default : $setting->id_address_default !!}</td>
                    <td>{{$m->id_number}}</td>
    				<td><a href="{{ route('members.edit', $m->id) }}" class="btn btn-info" title="Edit"><i class="fas fa-edit"></i></a> 
                        <a href="{{ route('record', $m->id) }}" class="btn btn-warning" title="Transaction"><i class="fas fa-random"></i></a> 
                        <a href="#myModal" class="btn btn-danger" data-id="{{$m->id}}" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false" title="Delete"><i class="fas fa-trash"></i></a>
                    </td>
    			</tr>
                @endforeach
                 @else
                <tr><td colspan="9"><h4>No members found.</h4></td></tr>
                @endif
            </tbody>
    		</table>

            </div>
<!-- Modal -->
 <div id="myModal" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="material-icons">&#xE5CD;</i>
                </div>   
                <h4 class="modal-title">Are you sure?</h4>  
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Do you really want to delete this member? This process cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <a type="button" id="cancel" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
                <a type="button" href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger">Delete</a>
                    <form method="post" id="deleteBtn" action="">
                        @method('DELETE')
                        <input type="hidden" name="_token" value=" {{ csrf_token() }}">
                    </form>
            </div>
        </div>
    </div>
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