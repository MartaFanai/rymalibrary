@extends('layouts.admin')
@section('content')
    
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Upload Publishers</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Upload Publishers</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
    	<div class="container">
         <div class="col-md-10">
      <div class="card">
        <div class="card-header bg-primary"><h5>Upload Publishers</h5></div>
          <div class="card-body">
            <form method="post" action="{{ route('publishers.upload') }}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <div class="form-group">
                <label>File Input (Datasheet)</label>

                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="inputGroupFile01"
                    aria-describedby="inputGroupFileAddon01" name="publisher" value="" required>
                   
                  <label class="custom-file-label" for="inputGroupFile01">Choose your publishers record of Excel/CSV file to be uploaded</label>
                </div>
                <p class="text-danger text-center">(If the <b>Publisher's Name</b> from the imported file is found in the database, it will be excluded during the import)</p>
                <p>
</p>
                   @if ($errors->has('image'))
                     <span class="invalid-feedback" role="alert">
                         <strong>{{ $errors->first('image') }}</strong>
                     </span>
                  @endif
            </div>

       </div>
              <div class="card-footer">
                  <div class="form-group">
                  <label></label>    
                  <input type="submit" class="btn btn-primary" value="Upload">
              </div>


              </div>
      </div>   
          </form>
    </div>
  </div>
</section>


        <script>
            $('#inputGroupFile01').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                
                  //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
                

            })

           
        </script>
        



@endsection