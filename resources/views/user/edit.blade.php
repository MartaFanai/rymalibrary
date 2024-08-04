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
            <form method="post" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
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

              <!-- Add the file input field, image preview element, and crop button to the HTML body -->
              <div class="form-group">
                  <div class="custom-file">
                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="image">
                      <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                  </div>
              <div class="img-preview" style="padding: 10px;"></div>
              <button type="button" class="btn btn-primary" id="crop-button" style="display: none;">Crop Image</button>
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
$(document).ready(function() {

    // Initialize Cropper.js on the image preview element
    const image = document.createElement('img');
    const cropper = new Cropper(image, {
        aspectRatio: 1, // set the aspect ratio of the crop box
        viewMode: 1, // set the view mode to restrict the crop box within the container
    });

    // Listen for changes in the file input field and load the selected image into the preview element
    $('#inputGroupFile01').on('change', function() {
        const input = $(this)[0];
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                image.src = e.target.result;
                $('.img-preview').html(image);
                cropper.replace(image.src); // replace the original image with the preview image in Cropper.js
                $('#crop-button:hidden').show();
            }
            reader.readAsDataURL(input.files[0]);
        }
        Filevalidation();
    });

    // Listen for the crop button click event and get the cropped image data
    $('#crop-button').on('click', function() {
    const croppedCanvas = cropper.getCroppedCanvas({
        width: 400, // set the desired width of the cropped image
        height: 400, // set the desired height of the cropped image
    });
    const croppedImage = croppedCanvas.toDataURL('image/jpeg'); // get the cropped image data as a base64-encoded JPEG

    // create a new image element for the cropped image
    const newImage = document.createElement('img');
    newImage.src = croppedImage;

    // replace the existing image element with the new one
    $('.img-preview').html(newImage);

    // save the cropped image with the original file name in another folder
    const originalFileName = $('#inputGroupFile01').val().split('\\').pop();
    const newFileName = '1'+originalFileName;
    $.ajax({
        type: 'POST',
        url: '{{ route("save-cropped-image") }}',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {
            croppedImage: croppedImage,
            newFileName: newFileName,
        },
        success: function(response) {
            console.log(response);
            if (response.success) {
                // update the file input field with the name of the cropped image file
                $('#inputGroupFile01').val(response.filename);
                alert('Image cropped and saved successfully!');
            } else {
                $('#inputGroupFile01').val(window.location.origin + '/storage/app/picture/' + newFileName);
               
            }
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
            alert('Error saving cropped image!');
        }
    });

});

    // Validate the selected file size
    Filevalidation = () => { 
        const fi = document.getElementById('inputGroupFile01'); 
        // Check if any file is selected. 
        if (fi.files.length > 0) { 
            for (let i = 0; i <= fi.files.length - 1; i++) { 
                const fsize = fi.files.item(i).size; 
                const file = Math.round((fsize / 1024)); 
                // The size of the file. 
                if (file >= 2048) { 
                    location.reload();
                    alert("File too big, please select a file less than 2MB");
                } else { 
                    document.getElementById('size').innerHTML = '<b>' + file + '</b> KB'; 
                } 
            } 
        } 
    }

});
</script>



@endsection
