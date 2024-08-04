@extends('layouts.admin')
@section('content')

<style type="text/css">
    .content{
    background-color: none;
}

@media print {
  #printPageButton {
    display: none;
  }

  .col-md-4 {
    width: 25%; /* Adjust this value as needed */
    box-sizing: border-box;
  }

} 

@page {
  size: A4;
  margin: 0;
} 

</style>

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">MultiQRcode Preview</h1>
            <br>
            <div class="button">
                <input id="printPageButton" class="btn btn-success" type="button" value="Print Now" onclick="window.print()">
                <a id="printPageButton" href="{{ route('code') }}" class="btn btn-secondary" title="Generate Barcode"><i class="fas fa-back"></i> Back </a> 
                
            </div>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">MultiQRcode Preview</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
    	<div class="container">
    		<div class="main mt-4" id="printArea"> 
               <?php $i = 0; ?>
              <div class="row m-5">
               @foreach($book as $b) 
                <div class="col-md-4">
                  <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($b->accessionno, 'QRCODE', 5, 5)}}" alt="QRCode">
                 <br>Acc. No:{{$b->accessionno}}
               <br><br><br><br>
               @if ($loop->iteration % 4 == 0)
                </div>
                
                <div class="row">
               @endif
             </div>
                 <br><br>
               @endforeach  

            </div>
            <div class="button">
                <input id="printPageButton" class="btn btn-success" type="button" value="Print Now" onclick="window.print()">
                <a id="printPageButton" href="{{ route('code') }}" class="btn btn-secondary" title="Generate Barcode"><i class="fas fa-back"></i> Back </a> 
                
            </div><br>
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