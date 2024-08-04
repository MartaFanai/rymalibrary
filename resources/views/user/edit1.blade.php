@extends('layouts.admin')
@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a></li>
              <li class="breadcrumb-item active">Edit User</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
    	<div class="container">
        <div class="col-md-10">
      <div class="card border-dark mb-3">
        <div class="card-header bg-info"><h5>Edit User details</h5></div>
          <div class="card-body text-dark">
            <form method="post" action="{{ route('users.update',$user->id) }}" enctype="multipart/form-data">
                @method('PUT')
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <div class="form-group">
                  <label>Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Full Name" value="{{ $user->name }}">
             </div>

              <div class="form-group">
                  <label>Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email" value="{{ $user->email }}">
              </div>

              <div class="form-group">
                  <label>New Password</label>
                    <input type="password" id="password" class="form-control" name="password" placeholder="Password (Change if you want to modify existing password)">
              </div>

              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="inputGroupFile01"
                    aria-describedby="inputGroupFileAddon01" name="image" onchange="Filevalidation()">
                  <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
              </div>

              <div class="form-group">
                  <div class="col-sm-2"></div>
                  <div class="col-sm-4">
                      <img src="{{ asset('storage/users/'.$user->image) }}" style="width: 100px; border:4px solid #ccc;">
                  </div>
                  <div class="clearfix"></div>

              </div>

        </div>

            <div class="card-footer">
                  <div class="form-group">
                  <label></label>    
                  <input type="submit" class="btn btn-info" value="Update">
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
                Filevalidation();
            })
        </script>

<script> 
    Filevalidation = () => { 
        const fi = document.getElementById('inputGroupFile01'); 
        // Check if any file is selected. 
        if (fi.files.length > 0) { 
            for (const i = 0; i <= fi.files.length - 1; i++) { 
  
                const fsize = fi.files.item(i).size; 
                const file = Math.round((fsize / 1024)); 
                // The size of the file. 
                if (file >= 2048) { 

                    alert( 
                      "File too Big, please select a file less than 2mb");
                } else { 
                    document.getElementById('size').innerHTML = '<b>'
                    + file + '</b> KB'; 
                } 
            } 
        } 
    } 
</script> 

@endsection
