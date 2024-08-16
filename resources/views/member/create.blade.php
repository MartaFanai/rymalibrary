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
            <h1 class="m-0 text-dark">Add Member</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('members.index') }}">Members</a></li>
              <li class="breadcrumb-item active">Add Members</li>
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
        <div class="card-header bg-primary"><h5>Add New Member</h5></div>
          <div class="card-body">
            <?php $now = Carbon\Carbon::now()->format('Y'); ?>
            <form method="post" action="{{ route('members.store') }}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="year" value="{{$now}}">

              <div class="form-group">
                  <label>Name <span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="name" placeholder="Name" autofocus required />
              </div>

              <div class="form-group">
                  <label>Gender <span class="text-danger"> *</span></label>
                  
                    <select name="gender" class="form-control col-4" required>
                          <option value=""> Select Gender </option>
                          <option value="Male"> Male </option>
                          <option value="Female"> Female </option>
                    </select>
                  
             </div>

              <div class="form-group">
                  <label>Family Relationship</label>

                  <div class="row">
                    <div class="col-3">
                      <select name="relation" id="relation" class="form-control">
                          <option value=""> Select Relation </option>
                          <option value="S/o"> S/o </option>
                          <option value="D/o"> D/o </option>
                          <option value="H/o"> H/o </option>
                          <option value="W/o"> W/o </option>
                      </select>
                    </div>
                    
                    <div class="col-9">
                      <input type="text" class="form-control" name="relationName" placeholder="Father/Mother/Spouse's Name" id="relationName" oninput="activateRequired(this)">
                    </div>
                  </div>
              </div>

              <div class="form-group">
                  <label>Section</label>
                    <select name="section" class="form-control col-4" required>
                            <option value=""> Select Section </option>
                            <option value="Khuangchera"> Khuangchera Section </option>
                            <option value="Neuva"> Neuva Section </option>
                            <option value="Taitesena"> Taitesena Section </option>
                            <option value="Vanapa"> Vanapa Section </option>
                    </select>
              </div>
 
              <div class="form-group">
                  <label>Mobile Number <span class="text-danger"> *</span></label>
                  <input type="tel" id="numberField" class="form-control" name="mobile" placeholder="Mobile Number" onkeypress="return this.value.length < 10;" oninput="if(this.value.length>=10) { this.value = this.value.slice(0,10); }" pattern="[0-9]{10}" required>
              </div>

              <div class="form-group">
                  <label>Address</label> <span class="text-xs">(Leave it blank if you want to display default address only. <span class="text-danger">Do not repeat the default address)</span></span>
                  <textarea class="form-control" name="address" rows="2" placeholder="{!! 'Address (House No, Street Name, Upa Bial, Section)&#13;&#10;Default Address : '.$setting->id_address_default !!}"></textarea>
              </div>

              <?php 
 
                $year = Carbon\Carbon::now()->format('y'); 
                $next_id = $max+1;
                if(isset($max))
                {
                    $real_id = $max; 
                    $i = 0;
                    //Counting digit numbers
                    while($real_id != 0)
                    {
                      $real_id = $real_id/10;
                      $real_id = intval($real_id);
                      ++$i;
                    }
                    
                    if($i == 1)
                    {
                      $id = 2;
                    }
                    elseif ($i == 2) {
                      $id = 1;
                    }
                    else
                    {
                      $id = 0;
                    }
                  }
                  else
                  {
                    $id = 2;
                  }

                  $capacity = '%0'.$setting->id_capacity.'d';
              ?>

              <div class="form-group">
                  <label>ID Number</label>
                  <input type="text" class="form-control" name="id_number" placeholder="ID Number" value="{{ $setting->id_code_prefix }}/{{$year}}/@if($id==2)<?php $no=sprintf($capacity, $next_id); ?>{{$no}}@elseif($id==1)<?php $no=sprintf($capacity, $next_id); ?>{{$no}}@else<?php $no=sprintf($capacity, $next_id) ?>{{$no}}@endif" readonly>

              </div> 

              <input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="rid" value="{{$next_id}}">

              <!-- Add the file input field, image preview element, and crop button to the HTML body -->
              <div class="form-group">
                  <div class="custom-file">
                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="image">
                      <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                  </div>
                <div class="img-preview" style="padding: 10px;"></div>
                <button type="button" class="btn btn-warning" id="crop-button" style="display:none;">Crop Image</button>
              </div>



         </div>
              <div class="card-footer">
                  <div class="form-group">
                  <label></label>    
                  <input type="submit" class="btn btn-primary" value="Submit">
                  <a id="printPageButton" href="{{ Route('members.index') }}" class="btn btn-secondary" title="Generate Barcode"><i class="fas fa-back"></i> Back </a>
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

<script>
  function activateRequired(relationName) {
      var dropdown = document.getElementById('relation');

      if (relationName.value == "") {
          dropdown.required = false;
      } else {
          dropdown.required = true;
          console.log('activate');
      }
    }
</script>

@endsection