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
            <h1 class="m-0 text-dark">Book List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ '/home' }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('books.index') }}">Books</a></li>
              <li class="breadcrumb-item active">Book List</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
    	<div class="container-fluid">
            <p>
               
            </p>
    		
    		<table class="table table-bordered table-striped table-hover" id="example1">
                <thead>
    			<tr>
    				<th>#</th>
    				<th width="10%">Title</th>
    				<th>Author</th>
                    <th>Edtn.</th>
                    <th>Vol.</th>
                    <th>Publisher</th>
                    <th width="7%">Acc. No</th>
                    <th width="7%">Clas. No</th>
                    <th width="10%">Subject</th>
                    <th width="4%">Book No</th>
    				<th>Source</th>
                    <th>Status</th>
    				<th width="4%">Action</th>
    			</tr>
                </thead>
                <tbody> <?php $i = 1; $j = 0; ?>
                @if(count($books))
    			@foreach($books as $b)
 
                <tr>
    				<td>{{$i++}}</td>
    				<td>{{$b->title}}</td>
    				<td>{{ $b->author->name }}</td>
                    <td>{{$b->edition ?? 'N/A'}}</td>
                    <td>{{$b->volume ?? 'N/A'}}</td>
    				<td>{{$b->publisher->name}}</td>
    				<td>{{$b->accessionno}}</td>
                    <td>{{$b->classificationno}}</td>
                    <td>{{$b->subject}}</td>
                    <td>{{$b->bookno}}</td>
                    <td>{{$b->description}}</td>
                    <td>@if($b->qty == 1)
                           <p>Available</p>
                        @else
                            @if($b->member_id != 0)
                            <p class="borrower">Borrowed &nbsp;&nbsp;&nbsp;<i data-html="true" class="fas fa-binoculars fa-lg" data-toggle="tooltip" data-placement="top" title="Borrower: {{$b->member['name']}} <br> Issuer: {{$b->issuer}}"></i> </p>
                            
                            <?php $j++; ?>
                            @endif
                        @endif 
                    </td>
    				<td>
                        <a href="{{ route('books.edit', $b->id) }}" class="btn btn-info"><i class="fas fa-edit"></i></a> 
                    
                    
                    </td>
    			</tr>
    			@endforeach
                @else
                <tr><td colspan="12"><h4>No Books found.</h4></td></tr>
                @endif
                </tbody>
    		</table>

            <!-- Modal HTML -->
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
                <p>Do you really want to delete this record? The process cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <a type="button" id="cancel" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
                <a type="button" href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger">Delete</a>
                    <form method="POST" id="deleteBtn" action="">
                        @csrf
                        @method('DELETE')
                    </form>
            </div>
        </div>
    </div>
 </div>  

</div>
</section>

<script>
  
    $('#example1').DataTable( {
        "fnDrawCallback": function() {
                $('[data-toggle="tooltip"]').tooltip();
            },
        "lengthMenu": [[10, 20, 50, 100, -1], [10 , 20, 50, 100, "All"]],
    } );
 
   $(document).ready(function(){
       
        $('#myModal').on('show.bs.modal', function (e) {
            var id = $(e.relatedTarget).data('id');
            var url = "{{ route('books.destroy', ':id') }}";
            url = url.replace(':id', id);

            document.getElementById('deleteBtn').action = url;
        });
     
    });
   
</script>

@endsection