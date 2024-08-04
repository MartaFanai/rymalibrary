@extends('layouts.admin')
@section('content')
    
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Add Users</li>
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
        <div class="card-header bg-primary"><h5>Add New User</h5></div>
          <div class="card-body">
            <form onsubmit="return validate();" method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <div class="form-group">
                  <label>Name</label>
                    <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" placeholder="Full name"  autofocus>
                  @if ($errors->has('name'))
                     <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                     </span>
                 @endif
              </div>

              <div class="form-group">
                  <label>Email</label>
                    <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Email" >
                 @if ($errors->has('email'))
                     <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                     </span>
                 @endif
              </div>

              <div class="form-group">
                  <label>Password</label>
                    <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" id="password" onblur="validate()" >
                  @if ($errors->has('password'))
                     <span class="invalid-feedback" role="alert">
                         <strong>{{ $errors->first('password') }}</strong>
                     </span>
                  @endif
              </div>

              <div class="form-group">
                  <label>Confirm Password</label>
                  <input id="retype_password" type="password" class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" placeholder="Retype password" name="password_confirmation" id="password" onkeyup='check();'>
                   @if ($errors->has('password_confirmation'))
                     <span class="invalid-feedback" role="alert">
                         <strong>{{ $errors->first('password_confirmation') }}</strong>
                     </span>
                  @endif
              </div>

              <div class="form-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input  {{ $errors->has('image') ? ' is-invalid' : '' }}" id="inputGroupFile01"
                    aria-describedby="inputGroupFileAddon01" name="image" value="">
                   
                  <label class="custom-file-label" for="inputGroupFile01" name="image">Choose image (Size should be 2 Mb below)</label>
                </div>
                
                   @if ($errors->has('image'))
                     <span class="invalid-feedback" role="alert">
                         <strong>{{ $errors->first('image') }}</strong>
                     </span>
                  @endif
            </div>
@if (count($errors) > 0)
  <script> $(window).on('load',function(){
    var delayMs = 15; // delay in milliseconds

    setTimeout(function(){
        $('#myModal').modal('show');
    }, delayMs);
});</script>
@endif

            <!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title blink">Error!!!!</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
         @if (count($errors) > 0)

            <div class="alert alert-danger">

                <strong>Whoops!</strong> There were some problems with your input.

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>
            @endif
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


            <!--
              @if (count($errors) > 0)

            <div class="alert alert-danger">

                <strong>Whoops!</strong> There were some problems with your input.

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif
      -->
       </div>
              <div class="card-footer">
                  <div class="form-group">
                  <label></label>    
                  <input type="submit" class="btn btn-primary" value="Submit">
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
                var label = "Choose image (Size should be 2 Mb below)";
                if(this.files[0].size > 2000000)  //set required file size 2048 ( 2MB )
                { 
                   alert("The file you choose is more than 2 Mb. Please select another file.");
                  $(this).next('.custom-file-input').alt = ""; 
                  $(this).next('.custom-file-label').html(label);
                }
                else{
                  //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
                }

            })

           
        </script>
        



@endsection