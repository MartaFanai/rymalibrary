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

input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1.5); /* IE */
  -moz-transform: scale(1.5); /* FF */
  -webkit-transform: scale(1.5); /* Safari and Chrome */
  -o-transform: scale(1.5); /* Opera */
  padding: 10px;
}
</style>
<script>

$(".checklist").click(function() {
  $('.btns').toggle( $(".checklist:checked").length > 0 );
});

</script>
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Print Book Code</h1>
            <p>
                <table>
                <tr>
                <td><a href="{{ route('range') }}" class="btn btn-success">Print BarCode Multiple</a> </td> 
                <td><a href="{{ route('rangeQR') }}" class="btn btn-info"> Print QRCode Multiple</a></td>
                </tr>
                </table>
            </p>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ '/home' }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Print Book Code</li>
              
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
    		<p>
    			
    		</p>
    		<table class="table table-bordered table-striped table-hover" id="example1">
                <thead>
    			<tr>
    				<th>#</th>
    				<th>Title</th>
    				<th>Author</th>
                    {{-- <th>Edtn.</th> --}}
                    {{-- <th>Vol.</th> --}}
                    <th>Publisher</th>
                    <th width="10%">Acc. No</th>
                    <!-- <th>Clas. No</th> -->
                    <!-- <th>Subject</th> -->
                    <!-- <th>Book No</th> -->
    				<th width="15%">Action</th>
    			</tr>
                </thead>
                <tbody> <?php $i = 1; $j = 0; ?>
                @if(count($books))
    			@foreach($books as $b)


                <tr>
    				<td>{{$i++}}</td>
    				<td>{{$b->title}}</td>
    				<td>{{$b->author->name}}</td>
                    {{-- <td>{{is_null($b->edition) ? 'N/A' : $b->edition}}</td> --}}
                    {{-- <td>{{is_null($b->volume) ? 'N/A' : $b->volume}}</td> --}}
    				<td>{{$b->publisher->name}}</td>
    				<td>{{$b->accessionno}}</td>
                    <!-- <td>{{$b->classificationno}}</td> -->
                    <!-- <td>{{$b->subject}}</td> -->
                    <!-- <td>{{$b->bookno}}</td> -->
    				<td>
                        <a href="{{ route('barcodeposition', $b->id) }}" class="btn-lg btn-success" title="Generate Barcode"> &nbsp; <i class="fas fa-barcode"> &nbsp; </i></a> 
                    
                        <a href="{{ route('qrcode', $b->id) }}" class="btn-lg btn-info" title="Generate QRcode"> &nbsp; <i class="fas fa-qrcode"> &nbsp; </i></a>
                    
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
            var url = "{{ route('books.destroy', ':id') }}";
            url = url.replace(':id', id);

            document.getElementById('deleteBtn').action = url;
        });


        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })
        
    });

   
   
</script>

@endsection