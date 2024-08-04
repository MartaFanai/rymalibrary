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
            <h1 class="m-0 text-dark">QR Code Preview</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">QR Code Preview</li>
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
                 <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($book->accessionno, 'QRCODE', 5, 5)}}" alt="QRCode">
                 <br>Acc. No:{{$book->accessionno}}
                 </center>
                 <br><br>
            </div>
            <div class="button">
                <input id="printPageButton" class="btn btn-success" type="button" value="Print Now" onclick="window.print()">
                <a id="printPageButton" href="{{ Route('code') }}" class="btn btn-secondary" title="Generate Barcode"><i class="fas fa-back"></i> Back </a> 
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