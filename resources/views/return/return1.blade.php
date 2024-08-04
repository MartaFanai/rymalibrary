@extends('layouts.admin')
@section('content')

@push('head')
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> --}}
  {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> --}}
  {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> --}}

  <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('css/v3.3.6/bootstrap.min.css') }}">
  <script type="text/javascript" src="{{ asset('js/v3.3.6/bootstrap.min.js') }}"></script>

@endpush
 <?php
      $segment = Request::segment(3);
      
     ?>
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Return Books</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('return') }}">Return Home</a></li>
              <li class="breadcrumb-item active">Return Books</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container">
        <div class="col-md-12">
      <div class="card border-dark mb-3">
         @foreach($return as $r)
           <?php  $name = $r->member->name; ?>
         @endforeach
        <div class="card-header bg-danger"><h5>Return Section for <strong>{{ $name }}</strong></h5></div>

   <div class="table-responsive mt-4">
                <form method="post" id="dynamic_form" action="{{ route('dynamic-field.insert') }}">
                 <span id="result"></span>
                 <table class="table table-bordered table-striped" id="user_table">
               <thead>
                <tr>
                    <th width="10">#</th>
                    <th width="30%">Book</th>
                    <th width="10%">Issue Date</th>
                    <th width="10%">Return Date</th>
                    <th width="15%">Duration</th>
                    <th width="25%">Action</th>
                </tr>
               </thead>
               <?php $no = 1; ?>
               <tbody>
                @foreach($return as $r)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $r->book->title }}</td>
                  <td>{{\Carbon\Carbon::parse($r->issueDate)->format('d/m/Y') }}</td>
                  <td>{{\Carbon\Carbon::parse($r->retDate)->format('d/m/Y') }}</td>
                  <td>
                    <?php
                      $last_date = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $r->retDate);
                      $current = \Carbon\Carbon::now();
                      $remaining_days = $current->diffInDays($last_date);
                      $statusDate =  $last_date->isBefore($current);
                    ?>
                    @if($statusDate != 1)
                      <p class="text-success">{{ $remaining_days }} Days Remaining</p>
                      <?php $flag = 1; ?>
                    @else
                      <p class="text-danger">Late for {{ $remaining_days }} Days</p>
                      <?php $flag = 0; ?>
                    @endif
                  </td> 
                  <td>
                    @if($flag == 1)
                      <a href="{{ route('retBooks', $r->id) }}" class="btn btn-success">Return Book</a>
                    @else
                      <a href="#" class="btn btn-danger" data-days="{{$remaining_days}}" data-id="{{$r->id}}" data-toggle="modal" data-target="#modal-info" data-backdrop="static" data-keyboard="false">Pay Fine</a>
                    @endif
                  </td>
                </tr>
                @endforeach
               </tbody>
               
           </table>
        </form>
   </div>


<div class="modal fade" id="modal-info">
        <div class="modal-dialog">
          <div class="modal-content bg-info">
            <div class="modal-header">
              <h4 class="modal-title">Payment Section (Late for <b id="date"></b> Days)</h4>
            <!--  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                <span aria-hidden="true">&times;</span></button> -->
            </div>
            <div class="modal-body">
            
              <h3>Late Fees to pay is <b>&#8377;  <label id="here"></label>/-</b> only.</h3>

              <div class="form-group row">
                <div class="clearfix"></div>
              </div>

              <div class="container-fluid">
              <div class="row">
               
                <div class="form-group col-sm-4"><h4>Amount Paid</h4></div>
                <div class="form-group col-sm-4">
                  <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <b style="font-size: 16.5px;">&#8377;</b>
                    </span>
                  </div>
                  <input type="number" min="0" id="fine" name="fine" class="form-control" style="size: 5px;" disabled></div> 
                  
                </div>
                <div class="form-group col-sm-4" style="text-align: center;">
                  <a type="submit" id="pay_now" class="btn btn-warning">Pay Now</a></div>
              </div>
              </div>
            </form>
          </div>

            <div class="modal-footer justify-content-between">
              <button type="button" id="close" class="btn btn-danger" data-dismiss="modal">Close</button>
              <a type="button" id="print_receipt" class="btn btn-success" style="display: none;">Print Receipt</a>

              <a type="button" id="return_now" class="btn  btn-success" style="display: none;">Return Book</a>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

  </div>

</div>

</div>

<?php 

$month = date('m');
$day = date('d');
$year = date('Y');

$today = $year . '-' . $month . '-' . $day;
?>

<script>
 
$(document).ready(function(){

  $(document).on('click', '#close', function(){
      history.go(0);
  });

  $('#modal-info').on('show.bs.modal', function (e) {
    var rem_days = $(e.relatedTarget).data('days');
    var id = $(e.relatedTarget).data('id');
    var rate = 5;

    var amount = rem_days * rate;

    document.getElementById('date').innerHTML 
                = rem_days;
    document.getElementById('fine').value 
                = amount; 
    document.getElementById('fine').autofocus 
                = true;
    document.getElementById('here').innerHTML 
                = amount;

    var url = "{{ route('inv', ':id') }}";
    url = url.replace(':id', id);

    document.getElementById('print_receipt').href = url;

    var url1 = "{{ route('retBooks', ':id') }}";
    url1 = url1.replace(':id', id);

    document.getElementById('return_now').href = url1;
     
});


  $(document).on('click', '#pay_now', function(){
    var print_receipt = document.getElementById('print_receipt');
    document.getElementById('pay_now').className = "btn btn-secondary disabled";
    $("#print_receipt").show();
    
 });

  $(document).on('click', '#print_receipt', function(){
    var print_receipt = document.getElementById('print_receipt');
    $("#return_now").show();
    document.getElementById('print_receipt').className = "btn btn-secondary disabled";
    document.getElementById('close').className = "btn btn-secondary disabled";
 });

  $(document).on('click', '#return_now', function (){
    document.getElementById('close').className = "btn btn-danger active";
    document.getElementById('return_now').className = "btn btn-secondary disabled";
  });



   $('#myModal').modal({backdrop: 'static', keyboard: false})  


 $("select").chosen({allow_single_deselect:true});

$('.selectpicker option:selected').val();

 $(document).on('click', '#add', function(){
  count++;
  dynamic_field(count);
 });

 $(document).on('click', '#remove', function(){
  count--;
  $(this).closest("tr").remove();
 });

 $('#dynamic_form').on('save', function(event){
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:$(this).serialize(),
            dataType:'json',
            beforeSend:function(){
                $('#save').attr('disabled','disabled');
            },
            success:function(data)
            {
                if(data.error)
                {
                    var error_html = '';
                    for(var count = 0; count < data.error.length; count++)
                    {
                        error_html += '<p>'+data.error[count]+'</p>';
                    }
                    $('#result').html('<div class="alert alert-danger">'+error_html+'</div>');
                }
                else
                {
                    dynamic_field(1);
                    $('#result').html('<div class="alert alert-success">'+data.success+'</div>');
                }
                $('#save').attr('disabled', false);
            }
        })
 });

  var mySelect = $('#first-disabled2');

    $('#special').on('click', function () {
      mySelect.find('option:selected').prop('disabled', true);
      mySelect.selectpicker('refresh');
    });

    $('#special2').on('click', function () {
      mySelect.find('option:disabled').prop('disabled', false);
      mySelect.selectpicker('refresh');
    });

    $('#basic2').selectpicker({
      liveSearch: true,
      maxOptions: 1
    });

});


</script>

@endsection