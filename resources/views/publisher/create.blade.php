@extends('layouts.admin')
@section('content')

<style type="text/css">
  input[type="number"] {
  -moz-appearance: textfield;
}
input[type="number"]::-webkit-inner-spin-button, 
input[type="number"]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
</style>
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add Publisher</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('authors.index') }}">Publisher</a></li>
              <li class="breadcrumb-item active">Add Publisher</li>
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
        <div class="card-header bg-primary"><h5>Add New Publisher</h5></div>
          <div class="card-body">
            
            <form method="post" action="{{ route('publishers.store') }}">
              @csrf
              <div class="form-group">
                  <label>Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Publisher Name" autofocus required />
              </div>

         </div>
              <div class="card-footer">
                  <div class="form-group">
                  <label></label>    
                  <input type="submit" class="btn btn-primary" value="Submit">
                  <a href="{{ Route('publishers.index') }}" class="btn btn-secondary"><i class="fas fa-back"></i> Back </a>
              </div>
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