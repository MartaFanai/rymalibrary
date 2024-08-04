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
  -ms-transform: scale(1.7); /* IE */
  -moz-transform: scale(1.7); /* FF */
  -webkit-transform: scale(1.7); /* Safari and Chrome */
  -o-transform: scale(1.7); /* Opera */
  padding: 10px;
}
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $("#checkAll").click(function(){
            if($(this).is(":checked")){
                $(".checkItem").prop('checked', true);
            }
            else
            {
                $(".checkItem").prop('checked', false);
            }
        });
    });

</script>
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Enter Your Starting Accession No.</h1>
            <p>
                 
               <form method="POST" name="accessionStart" action="{{ route('rangeQRList') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
                <table>
                <tr>
                
                <td><a href="{{ route('code') }}" class="btn btn-secondary">Back</a></td>
                </tr>
                </table>
            </p>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ '/home' }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Select Accession Range</li>
              
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
    	<div class="container-fluid">
            <p>
               Enter the accession number below
            </p>
    		<p>
    			<div class="form-control">
            <div class="input-group">
              <input type="number" name="accessionNo" class="form-control" placeholder="Enter the Starting Accession Number to print" autocomplete="off" autofocus required>
              <div class="input-group-append">
                <button class="btn btn-secondary" type="submit">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div>
          </div>
    		</p>

    		

  </form>

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