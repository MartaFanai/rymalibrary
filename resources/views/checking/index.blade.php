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


       
        



@endsection