@extends('layouts.admin')
@section('content')
<style type="text/css">
.dataTables_filter {
   float: right !important;
}

.dataTables_filter input { 
    width: 350px 
}

.dataTables_paginate {
  float: right !important;
}

.main{
    background-image: url('/storage/image/id_bg.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    /*height: 5in;
    width: 7in;*/
    height: 3.8in;
    width: 5.4in;
    border-radius: 10px;
    margin: 25px 20px;
    position: relative;
}

.top{
    width: 100%;
    height: 20%;
    text-align: center;
}

.barcode{
    position: absolute;
    top: 147px;
    text-align: left;
    padding-left: 15px;
}
.bg{
    width: 100%;
    height: 13%;
    background-color: black;
    position: absolute;
    top: 95px;

}
.dp{
    width: 125px;
    position: absolute;
    top: 150px;
    left: 82%;
    border: 0.4px solid #ddd;
    border-radius: 4px;
    padding: 5px;
    transform: translate(-50%);
    box-shadow: 5px 5px 2px black;
    -moz-box-shadow: 5px 5px 2px black;
    -webkit-box-shadow: 5px 5px 2px black;
    -khtml-box-shadow: 5px 5px 2px black;
}
.detail{
    width: 65%;
    position: absolute;
    top: 180px;
    left: 15px;
}
.name{
    font-family: Great Vibes, sans-serif;
    /*font-size: 1.7em;*/
    font-weight: bold;
}
.fname{
    font-family: Great Vibes, sans-serif;
    font-size: 1.2em;
    line-height: 1.1em;
}
.sect{
     font-style: italic;
     font-size: 1.2em;
     top: 65px;
     position: absolute;
}
.address{
     font-style: italic;
     font-size: 1.2em;
     top: 90px;
     position: absolute;
     line-height: 1.2em;
}
.last{
    width: 97%; 
    top: 315px; 
    left: 15px; 
    position: absolute; 
    font-weight: bold;
    font-size: 1.3em;
}
.valid{
    text-align: right;
    position: absolute;
}
.content{
    background-color: white;
}

@media print {
  #printPageButton {
    display: none;
  }

  #printImageButton {
    display: none;
  }
}  

.html2canvas-container { width: 950 !important; height: 590 !important; } 

</style>

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">ID Preview</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('generateid') }}">ID Generate</a></li>
              <li class="breadcrumb-item active">ID Preview</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
    	<div class="container"  style="padding-left: 150px;">
    		<div class="main mt-4" id="printArea">
                <div id="image">
                    <p style="top: 7px; position: absolute; font-size: 30px; font-weight: bold; color: white; left: 13%; font-family: Arial, Helvetica, sans-serif;">Ramthar Veng Branch YMA</p>
                <div class="top">
                    <p style="padding-top: 50px; font-size: 30px; font-weight: bold; color: white; font-family: Arial,sans-serif;">LIBRARY</p>
                    <div class="bg"></div>
                    <p style="top: 93px; position: absolute; font-size: 35px; font-weight: bold; color: white; left: 15%; font-family: Arial, Helvetica, sans-serif;">MEMBERSHIP CARD</p>
                    
                </div>
                <div class="barcode">
                    {!! DNS1D::getBarcodeSVG($member->id_number, "C39", 1.5, 25, '#2A3239') !!}
                    
                </div>
                {{$member->image}}
                <img src="{{asset('storage/members/'.$member->image)}}" class="dp" >
                <div class="detail">
                    <div class="name" @if(strlen($member->name) <= 21 && strlen($member->name) >= 0) style="font-size: 1.7em;" @elseif(strlen($member->name) <= 25 && strlen($member->name) >= 22) style="font-size: 1.42em;" @elseif(strlen($member->name) <= 30 && strlen($member->name) >= 26) style="font-size: 1.25em;" @else style="font-size: 1.1em;" @endif >{{$member->name}}</div>  
                    @if(!is_null($member->relation))             
                    <div class="fname">@if($member->gender =="Male")
                                            S/o 
                                        @else
                                            D/o
                                        @endif   

                                {{$member->relationname}}
                    </div>   
                    @endif  

                    @if(!is_null($member->section))
                    <div class="sect">{{$member->section}} Section,</div>  
                    @endif 

                    <div class="address">@if(!is_null($member->address)){{$member->address}}, @endif <br> {{ $address->id_address_default }}</div> 
                                 
                </div>
                <div class="row mt-3 last">
                        <div class="col">ID No: {{$member->id_number}}</div>
                        <div class="col valid">Issue Date: {{Carbon\Carbon::now()->format('d/m/Y')}}</div>
                </div> 
            </div>
        </div>
            <div class="button">
                <input class="btn btn-success" id="printPageButton" type="button" value="Print Now" onclick="window.print()">
                <input class="btn btn-primary" id="printImageButton" type="button" value="Extract Image">
                <a id="printPageButton" href="{{ Route('generateid') }}" class="btn btn-secondary" title="Generate Barcode"><i class="fas fa-back"></i> Back </a>
            </div>
        </div>
    </section> 

<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/html2canvas.min.js') }}"></script>
<script src="{{ asset('js/canvas2image.js') }}"></script>

<script type="text/javascript">
    $('#printImageButton').click(function() {
        var fname = "<?php echo $member->name; ?>"; 
        var elm = $('#printArea').get(0);
        var width = elm.scrollWidth;
        var height = elm.scrollHeight;
        var type = "png";
        var filename = fname + "-ID-Card";
      
        html2canvas(elm, {
        logging: true,
        letterRendering: 1,
        useCORS: true,
        scrollX: 0,
        scrollY: -window.scrollY
    }).then(function(canvas) {
        Canvas2Image.saveAsImage(canvas, width, height, type, filename);
    });
});

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