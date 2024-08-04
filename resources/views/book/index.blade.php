@extends('layouts.admin')
@section('content')
<script src="js/jquery1.min.js"></script>
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
            <h1 class="m-0 text-dark">Book Search</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ '/home' }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Books</li>
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
    <a href="{{ route('books.create') }}" class="btn btn-primary">Add New Book</a>

    <a href="{{ route('viewbook') }}" class="btn btn-secondary">View All Books</a>

    @if(auth()->user()->role <= 0)
        <a href="{{ route('export') }}" class="btn btn-info"><i class="fas fa-download text-white"> Download CSV/Excel</i></a>

        <a href="{{ route('import') }}" class="btn btn-success"><i class="fas fa-upload text-white"> Upload CSV/Excel</i></a>

    @endif
</p>

    	
        <div class="container" style="max-width: 100%;">
        <div class="text-center mt-5 mb-4">
            
            <h2>LEHKHABU ZAWNNA</h2>
            <h6 class="text-secondary">(Lehkhabu neih zat : <b>{{ $books ? $books->count() : 0 }}</b>  | Lehkhabu hawh chhuah mek zat : <b>{{ $book ? $book->count() : 0 }}</b> )</h6>
        </div>

        <div class="row">
            <div class="col-lg-12"></div>
            <div class="col-lg-12">
                <div class="input-group">
                    <input type="text" class="form-control col-10 mx-auto" id="live-search" autocomplete="off" placeholder="Lehkhabu emaw a ziaktu Hming chhulut rawh.." autofocus="true">
                </div><!-- /input-group -->
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4"></div>
        </div><!-- /.row -->
        
    </div>

    <div id="searchresult" style="padding: 10px;"></div>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#live-search').keyup(function(){
                var input = $(this).val();

                if(input != ""){
                    $.ajax({
                        url:"{{ route('searchbook') }}",
                        method:"POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:{input:input},

                        success:function(data){
                            $("#searchresult").html(data);
                            $("#searchresult").css("display", "block");
                        }
                    });
                }else{
                    $("#searchresult").css("display", "none");
                }
            });
        });
    </script>

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

 <!-- View Modal -->
  <div id="viewModal" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="material-icons">&#xE5CD;</i>
                </div>   
                <h4 class="modal-title">Member Details</h4>  
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p><strong>ID:</strong> <span id="modal-id"></span></p>
                <p><strong>Name:</strong> <span id="modal-name"></span></p>
                <p><strong>ID Number:</strong> <span id="modal-id_number"></span></p>
                <p><strong>Year:</strong> <span id="modal-year"></span></p>
            </div>
            <div class="modal-footer">
                <a type="button" id="cancel" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
                
            </div>
        </div>
    </div>
 </div>

</section>

<script>
 
   $(document).ready(function(){
        // $('[data-toggle="tooltip"]').tooltip();

        $('#myModal').on('show.bs.modal', function (e) {
            var id = $(e.relatedTarget).data('id');
            var url = "{{ route('books.destroy', ':id') }}";
            url = url.replace(':id', id);

            document.getElementById('deleteBtn').action = url;
        });

        $('#viewModal').on('show.bs.modal', function (e) {
            var button = $(e.relatedTarget).raw('id'); // Button that triggered the modal
            var row = button.data('row'); // Extract info from data-* attributes

            // Parse JSON string to object
            var rowData = JSON.parse(row);

            // Update the modal's content
            var modal = $(this);
            modal.find('#modal-id').text(rowData.id);
            modal.find('#modal-name').text(rowData.name);
            modal.find('#modal-id_number').text(rowData.id_number);
            modal.find('#modal-year').text(rowData.year);
        });
     
    });
   
</script>

@endsection