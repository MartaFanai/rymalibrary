@extends('layouts.admin')
@section('content')

<style type="text/css">
    .content{
    background-color: white;
}

table {
        page-break-inside: auto;
      }
      tr {
        page-break-inside: avoid;
        page-break-after: auto;
      }
      thead {
        display: table-header-group;
      }

@media print {
  #printPageButton {
    display: none;
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
            <h1 class="m-0 text-dark">MultiBarcode Preview</h1>
            <br>
            <div class="button">
                <input id="printPageButton" class="btn btn-success" type="button" value="Print Now" onclick="window.print()">
                <a id="printPageButton" href="{{ route('code') }}" class="btn btn-secondary" title="Generate Barcode"><i class="fas fa-back"></i> Back </a> 
                
            </div>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">MultiBarcode Preview</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
    	<div class="container">
    		<div id="printArea"> 
               <?php $i = 0; ?>
              <div class="row">
                
              <table border="0" style="table-layout: fixed;">
                <thead><tr><th><br><br><br></th><th><br><br><br></th><th><br><br><br></th><th><br><br><br></th><th><br><br><br></th></tr></thead>
                <tr>
                 @foreach($book as $b) 
                  <td align="center" style="width: 51mm; height: 26.7mm; padding-top: 23px; padding-bottom: 14px;">
                    <div > 
                       {!! DNS1D::getBarcodeSVG($b->accessionno, "C39", 1.3, 40, '#2A3239') !!}
                       <br>Acc. No:{{$b->accessionno}}
                    </div>
                  </td>
                  @if($loop->iteration % 5 == 0)
                    </tr>
                    <tr>
                  @endif
                 @endforeach  
                </tr>
               </table>
            </div>
            <div class="button">
                <input id="printPageButton" class="btn btn-success" type="button" value="Print Now" onclick="window.print()">
                <a id="printPageButton" href="{{ route('code') }}" class="btn btn-secondary" title="Generate Barcode"><i class="fas fa-back"></i> Back </a> 
                
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