@extends('layouts.admin')
@section('content')

<link rel="stylesheet" href="{{ asset('plugins/rateyo/jquery.rateyo.min.css') }}">

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Member</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('members.index') }}">Member</a></li>
              <li class="breadcrumb-item active">Edit Members</li>
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
         
           
              
        <div class="card-header bg-info">
            <div class="row">
                <div class="col-md-6">
                    <h5>Edit Member details</h5>
                </div>
                <div class="col-md-6">
                    <h6 class="float-right">
                        Active until : <b>{{ $member->year }}</b> 
                        @if(auth()->user()->role <= 0)
                        <a href="{{ route('validity', $member->id) }}" class="text-warning"><i class="fas fa-edit"></i></a>
                        @endif
                    </h6>
                </div>
            </div>
        </div>
         <img class="img-circle elevation-2" src="{{ asset('storage/members/'.$member->image) }}" alt="User Avatar" style="display: block; position: absolute; visibility: visible; left: 370px; top: -40px; height: 120px; width: 120px; z-index: 1;  object-position: 50% 50%;">
          <div class="card-body text-dark">
            <form method="post" action="{{ route('members.update',$member->id) }}" enctype="multipart/form-data">
                @method('PUT')
                <input type="hidden" name="_token" value="{{ csrf_token() }}">


             <div class="form-group">
                  
                  <div style="width: 250px; margin: 10px auto;">
                     <div id="rateyo" class="rateyo" data-rateyo-rating="{{$member->rating}}" data-rateyo-num-stars="5" data-rateyo-score="0"></div>
                     <span class='result'> &nbsp; &nbsp;{{$member->rating}}</span>
                   </div>

                   
                  <input type="hidden" id="rating" name="rating" value="{{$member->rating}}">
                    
             </div>

             <div class="form-group">
                  <label>Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $member->name }}">
             </div>

             <div class="form-group">
                  <label>Gender</label>
                    <select name="gender" class="form-control" style="width:350px">
                                         
                        @if($member->gender != "nil")
                          <option value="{{ $member->gender }}">{{ $member->gender }}</option>
                            @if($member->gender == "Male")
                              <option value="Female"> Female </option>
                            @else if
                              <option value="Male"> Male </option>
                            @endif
                         @else
                          <option value="nil"> Select Gender </option>
                          <option value="Male"> Male </option>
                          <option value="Female"> Female </option>
                        @endif
                      
                </select>
             </div>

              <div class="form-group">
                  <label>Father/Mother/Spouse's Name</label>

                  <div class="row">
                    <div class="col-3">
                      <select name="relation" id="relation" class="form-control">
                        @if(!empty($member->relation))
                            <option value="{{ $member->relation }}"> {{ $member->relation }} </option>
                        @else
                          <option value=""> Select Relation </option>
                          <option value="S/o"> S/o </option>
                          <option value="D/o"> D/o </option>
                          <option value="H/o"> H/o </option>
                          <option value="W/o"> W/o </option>
                        @endif
                      </select>
                    </div>
                    
                    <div class="col-9">
                      <input type="text" class="form-control" name="relationName" placeholder="Father/Mother/Spouse's Name" id="relationName" oninput="activateRequired(this)" value="{{ $member->relationname }}">
                    </div>
                  </div>
              </div>

              {{-- <div class="form-group">
                  <label>Section</label>
                    <select name="section" class="form-control" style="width:350px">
                          <option value="{{ $member->section }}">{{ $member->section }}</option>
                          <option disabled="disabled"> -Dash- </option>
                          <option value="Khuangchera"> Khuangchera Section </option>
                          <option value="Neuva"> Neuva Section </option>
                          <option value="Taitesena"> Taitesena Section </option>
                          <option value="Vanapa"> Vanapa Section </option>
                  </select>
              </div> --}}  

              <div class="form-group">
                  <label>Mobile Number</label>
                  <input type="number" class="form-control" name="mobile" placeholder="Mobile Number" value="{{ $member->mobile }}" onkeypress="return this.value.length < 10;" oninput="if(this.value.length>=10) { this.value = this.value.slice(0,10); }">
              </div>

              <div class="form-group">
                  <label>Address</label>
                    <textarea class="form-control" name="address" rows="2" placeholder="Address">{{ $member->address }}</textarea>
              </div>

              <div class="form-group">
                  <label>ID Number</label>
                  <input type="text" class="form-control" name="id_number" placeholder="ID Number" value="{{ $member->id_number}}" readonly>
              </div>

              <!-- Add the file input field, image preview element, and crop button to the HTML body -->
              
              <div class="form-group">
                  <label>Member Image</label><span class="text-xs"> (Leave it blank if image is not available)</span>
                  <div class="custom-file">
                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="image">
                      <label class="custom-file-label" id="fileInputLabel" for="inputGroupFile01">Choose file</label>
                  </div>
                <div class="img-preview" style="padding: 10px;"></div>
                <button type="button" class="btn btn-warning" id="crop-button" style="display:none;">Crop Image</button>
              </div>

              <input type="hidden" id="croppedImageFileName" name="croppedImageFileName" value="">

              
           </div>

            <div class="card-footer">
                  <div class="form-group">
                     <input type="submit" class="btn btn-info" value="Update">
                     <a id="printPageButton" href="{{ Route('members.index') }}" class="btn btn-secondary" title="Generate Barcode"><i class="fas fa-back"></i> Back </a>
                     
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
  
<script type="text/javascript" src="{{ asset('plugins/rateyo/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/rateyo/jquery.rateyo.min.js') }}"></script>

<script type="text/javascript">
     $('#rateyo').rateYo({
        starWidth: '35px',
        normalFill: 'grey',
        ratefill: 'yellow'
        }) 
     $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
    var rating = data.rating;
    $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
    $(this).parent().find('.result').text('Rating :'+ rating);
    if(rating >= 0)
    {
      document.getElementById('rating').value = rating;
    }
    else
    {  
      document.getElementById('rating').value = "<?php echo $member->rating; ?>";
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