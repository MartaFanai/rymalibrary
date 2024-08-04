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
        //This line enable auto select the Select checkbox when page load
        $("#checkAll").click();

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
            <h1 class="m-0 text-dark">Print Multi QRCode</h1>
            <p>
                 
               <form method="POST" name="frm_example1" action="{{ route('multiqrprint') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
                <table>
                <tr>
                <td> <input type="submit" class="btn btn-success" value="Print QR Code"> </td>
                <td><a href="{{ route('code') }}" class="btn btn-secondary">Back</a></td>
                </tr>
                </table>
            </p>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ '/home' }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Print Multi QRCode</li>
              
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

    		<table class="table table-bordered table-striped table-hover" >
                <thead>
    			         <tr>
    				          <th>#</th>
    				          <th>Title</th>
    				          <th>Author</th>
                              <th>Edtn.</th>
                              <th>Publisher</th>
                              <th>Acc. No</th>
                              <!-- <th>Clas. No</th> -->
                              <!-- <th>Subject</th> -->
                              <!-- <th>Book No</th> -->
    				          <th>Select &nbsp; <input type="checkbox" id="checkAll" align="right"></th>
    			         </tr>
                </thead>
                <tbody> <?php $i = 1; $j = 0; ?>

          @if($books->isNotEmpty())

    			@foreach($books as $b)

                <tr>
    				        <td>{{$i++}}</td>
    				        <td>{{$b->title}}</td>
    				        <td>{{$b->author->name}}</td>
                            <td>{{is_null($b->edition) ? 'N/A' : $b->edition}}</td>
    				        <td>{{$b->publisher->name}}</td>
    				        <td>{{$b->accessionno}}</td>
                            <!-- <td>{{$b->classificationno}}</td> -->
                            <!-- <td>{{$b->subject}}</td> -->
                            <!-- <td>{{$b->bookno}}</td> -->
                    <td><center><input type="checkbox" class="checkItem" name="printid[]" value="{{$b->id}}" checked /></center></td>
    			</tr>
    			@endforeach
          
          @else
            <tr><td colspan="10"><h4>No books found.</h4></td></tr>
          @endif     
                </tbody>
    		</table>

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