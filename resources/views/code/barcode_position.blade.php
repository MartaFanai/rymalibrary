@extends('layouts.admin')
@section('content')

<style type="text/css">
    .content{
    background-color: white;
}

@media print {
  #printPageButton {
    display: none;
  }
}  

</style>

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Barcode Position</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Barcode position</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
    	<div class="container">
          
    		<div class="main mt-4" id="printArea"> 
                <center>
                  <form method="post" action="{{ route('barposition') }}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="id" value="{{$book->id}}">

                 <div class="form-group">
                  <label>Select Position to print your barcode</label>
                    <select name="position" class="form-control" style="width:350px" required>
                          <option value="1"> 1st Row 1st Column </option>
                          <option value="2"> 1st Row 2nd Column </option>
                          <option value="3"> 1st Row 3rd Column </option>
                          <option value="4"> 1st Row 4th Column </option>
                          <option value="5"> 1st Row 5th Column </option>

                          <option disabled> ------------------------- </option>

                          <option value="6"> 2nd Row 1st Column </option>
                          <option value="7"> 2nd Row 2nd Column </option>
                          <option value="8"> 2nd Row 3rd Column </option>
                          <option value="9"> 2nd Row 4th Column </option>
                          <option value="10"> 2nd Row 5th Column </option>

                          <option disabled> ------------------------- </option>

                          <option value="11"> 3rd Row 1st Column </option>
                          <option value="12"> 3rd Row 2nd Column </option>
                          <option value="13"> 3rd Row 3rd Column </option>
                          <option value="14"> 3rd Row 4th Column </option>
                          <option value="15"> 3rd Row 5th Column </option>

                          <option disabled> ------------------------- </option>

                          <option value="16"> 4th Row 1st Column </option>
                          <option value="17"> 4th Row 2nd Column </option>
                          <option value="18"> 4th Row 3rd Column </option>
                          <option value="19"> 4th Row 4th Column </option>
                          <option value="20"> 4th Row 5th Column </option>

                          <option disabled> ------------------------- </option>

                          <option value="21"> 5th Row 1st Column </option>
                          <option value="22"> 5th Row 2nd Column </option>
                          <option value="23"> 5th Row 3rd Column </option>
                          <option value="24"> 5th Row 4th Column </option>
                          <option value="25"> 5th Row 5th Column </option>

                          <option disabled> ------------------------- </option>

                          <option value="26"> 6th Row 1st Column </option>
                          <option value="27"> 6th Row 2nd Column </option>
                          <option value="28"> 6th Row 3rd Column </option>
                          <option value="29"> 6th Row 4th Column </option>
                          <option value="30"> 6th Row 5th Column </option>

                          <option disabled> ------------------------- </option>

                          <option value="31"> 7th Row 1st Column </option>
                          <option value="32"> 7th Row 2nd Column </option>
                          <option value="33"> 7th Row 3rd Column </option>
                          <option value="34"> 7th Row 4th Column </option>
                          <option value="35"> 7th Row 5th Column </option>

                          <option disabled> ------------------------- </option>

                          <option value="36"> 8th Row 1st Column </option>
                          <option value="37"> 8th Row 2nd Column </option>
                          <option value="38"> 8th Row 3rd Column </option>
                          <option value="39"> 8th Row 4th Column </option>
                          <option value="40"> 8th Row 5th Column </option>

                          <option disabled> ------------------------- </option>

                          <option value="41"> 9th Row 1st Column </option>
                          <option value="42"> 9th Row 2nd Column </option>
                          <option value="43"> 9th Row 3rd Column </option>
                          <option value="44"> 9th Row 4th Column </option>
                          <option value="45"> 9th Row 5th Column </option>

                          <option disabled> ------------------------- </option>

                          <option value="46"> 10th Row 1st Column </option>
                          <option value="47"> 10th Row 2nd Column </option>
                          <option value="48"> 10th Row 3rd Column </option>
                          <option value="49"> 10th Row 4th Column </option>
                          <option value="50"> 10th Row 5th Column </option>

                          <option disabled> ------------------------- </option>

                          <option value="51"> 11th Row 1st Column </option>
                          <option value="52"> 11th Row 2nd Column </option>
                          <option value="53"> 11th Row 3rd Column </option>
                          <option value="54"> 11th Row 4th Column </option>
                          <option value="55"> 11th Row 5th Column </option>

                          <option disabled> ------------------------- </option>

                          <option value="56"> 12th Row 1st Column </option>
                          <option value="57"> 12th Row 2nd Column </option>
                          <option value="58"> 12th Row 3rd Column </option>
                          <option value="59"> 12th Row 4th Column </option>
                          <option value="60"> 12th Row 5th Column </option>

                          <option disabled> ------------------------- </option>

                          <option value="61"> 13th Row 1st Column </option>
                          <option value="62"> 13th Row 2nd Column </option>
                          <option value="63"> 13th Row 3rd Column </option>
                          <option value="64"> 13th Row 4th Column </option>
                          <option value="65"> 13th Row 5th Column </option>
                    </select>
             </div>
                 
                 </center>
                 <br><br>
            </div>
            <div class="button">
              <div class="form-group">
                  <label></label>  
                  <center>  
                  <input type="submit" class="btn btn-primary" value="Submit">
                  <a id="printPageButton" href="{{ Route('code') }}" class="btn btn-secondary" title="Generate Barcode"><i class="fas fa-back"></i> Back </a>
                </center>
              </div>
                </form>
                
            </div>
        </div>
    </section> 

<script type="text/javascript">
    function printId()
    {
        var prtContent = document.getElementById("printArea");
        var WinPrint = window.open();
        WinPrint.document.write(prtContent.innerHTML);
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();
        WinPrint.close();
    }
</script>

 @endsection