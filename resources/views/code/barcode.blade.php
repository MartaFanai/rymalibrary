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
            <h1 class="m-0 text-dark">Barcode Preview</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Barcode Preview</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
    	<div class="container">

    		<div id="printArea"> 
                <div class="row">
                
              <table border="0" style="table-layout: fixed;">
                <thead><tr><th><br><br></th><th><br><br></th><th><br><br></th><th><br><br></th><th><br><br></th></tr></thead>
                <tr style="vertical-align: middle;">
                 @for($i=1; $i <= $position; $i++)
                  <td align="center" style="width: 51mm; height: 26.7mm; padding-top: 17px; padding-bottom: 17px;">

                    @if($i == $position)

                    <div style="vertical-align: middle;"> 
                      <!-- Here @ is prefix to divert syntax error for wamp64 3.3.1 -->
                       {!! DNS1D::getBarcodeSVG($book->accessionno, "C39", 1.3, 40, '#2A3239') !!}
                       <br>Acc. No:{{$book->accessionno}}
                    </div>

                    @endif

                  </td>

                  @if($i % 5 == 0)
                    </tr>
                    <tr>
                  @endif

                 @endfor 

                </tr>
               </table>
            </div>
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