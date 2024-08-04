@extends('layouts.admin')
@section('content')

@push('head')
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Issue Books</title>
  {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> --}}
  <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
  {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> --}}
  <link rel="stylesheet" href="{{ asset('css/v3.3.6/bootstrap.min.css') }}">
  {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
  --}}
  <script type="text/javascript" src="{{ asset('js/v3.3.6/bootstrap.min.js') }}"></script>



@endpush


<style>
  #saves {
    transition: 0.5s; /* Optional: Add a transition for a smooth effect */
  }

  #saves:hover {
    content: "Inactive Member";
  }
</style>

<script>
  $(document).ready(function () {
    $('#saves').hover(function () {
      $(this).val('Inactive Member');
    }, function () {
      $(this).val('Issue Book');
    });
  });
</script>

 <?php
      $segment = Request::segment(3);
      
     ?>
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Issue Books</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('issue') }}">Issue Home</a></li>
              <li class="breadcrumb-item active">Issue Books</li>
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
        <div class="card-header bg-primary"><h5>Issue Section</h5></div>

   <div class="table-responsive mt-4" style="display: block; height: 380px; z-index: 1; position: relative;">
                <form method="post" id="dynamic_form" action="{{ route('dynamic-field.insert') }}">
                 <span id="result"></span>
                 <table class="table table-bordered table-striped" id="user_table">
               <thead>
                <tr>
                    <!-- <th width="10%">Member ID</th> -->
                    <th width="30%">Book Title (Accession No) - Author</th>
                    <th width="25%">Issue Date</th>
                    <th width="25%">Return Date</th>
                    <th width="5%">Action</th>
                </tr>
               </thead>
               <tbody>

               </tbody>
               <tfoot>
                <tr>
                  <td colspan="5" align="right">&nbsp;
                  @csrf
                  <?php 
                    $nos = count($issue);
                  ?>

                  @if( $member->first()['year'] < date('Y') )
                    <input type="submit" name="save" id="saves" class="btn btn-primary" value="Issue Book" disabled />
                  @else

                    @if($nos < $setting->no_of_books_per_member)
                      <input type="submit" name="save" id="save" class="btn btn-primary" value="Issue Book" />
                    @else
                      <input data-html="true" type="submit" name="save" id="save" class="btn btn-primary" value="Issue Book" data-toggle="tooltip" data-placement="top" title="Maximum books reach" disabled />
                    @endif

                  @endif

                 </td>
                </tr>
               </tfoot>
           </table>
        </form>
   </div>
       @foreach($member as $m)         
<h4 align="center">Current Transaction for {{ $m->name }}</h4>
@endforeach
<div style="display: block; border-style: solid; border:1px solid black;">
    <div class="row" style="background: lightblue;">
        <div class="col-lg-1"><h4>Sl.No.</h4></div>
        <div class="col-lg-3"><h4>Book Name</h4></div>
        <div class="col-lg-2"><h4>Author</h4></div>
        <div class="col-lg-2"><h4>Issue Date</h4></div>
        <div class="col-lg-2"><h4>Return Date</h4></div>
        <div class="col-lg-2"><h4>Remarks</h4></div>
    </div>

    <?php
      $no = 1;
    ?>

@if($issue->count())
   <div style="display: block; border-style: solid; border:1px solid black;">
</div>
@foreach($issue as $i)
    <div class="row">
        <div class="col-lg-1" style="text-align: center;">{{ $no++ }}</div>
        <div class="col-lg-3">{{ $i->book->title }}</div>
        <div class="col-lg-2">{{ $i->book->author->name }}</div>
        <div class="col-lg-2">{{ \Carbon\Carbon::parse($i->issueDate)->format('d/m/Y') }}</div>
        <div class="col-lg-2">{{ \Carbon\Carbon::parse($i->retDate)->format('d/m/Y') }}</div>

        <?php
          $last_date = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $i->retDate);
          $current = \Carbon\Carbon::now();
          $remaining_days = $current->startOfDay()->diffInDays($last_date);
          $statusDate =  $last_date->isBefore($current);
        ?>

        @if($statusDate != 1)
          <div class="col-lg-2">
            @if($remaining_days != 0)
              <a href="{{ route('returnBooks', $i->member_id) }}" class="text-success">{{ $remaining_days }} Days Remaining</a></div>
            @else
              <a href="{{ route('returnBooks', $i->member_id) }}" class="text-warning">Last day for returning</a></div>
            @endif
        @else
          <div class="col-lg-2"><a href="{{ route('returnBooks', $i->member_id) }}" class="text-danger">Late for {{ $remaining_days }} Days</a> </div>
        @endif
    </div>
  @endforeach

  @else
  <div class="row">
    <div class="col-lg-12" style="text-align: center;">
      <p><h5>No transaction found</h5></p>
    </div>
  </div>
@endif
</div> 


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

 $('[data-toggle="tooltip"]').tooltip();

 var count = 1;
 var check = {{ $setting->no_of_books_per_member - $nos }};
 
 var no_of_days = {{ $setting->no_of_days_for_lending }};

 var defaultDate = new Date();
 defaultDate.setDate(defaultDate.getDate() + no_of_days);

 var formattedDefaultDate = defaultDate.toISOString().split('T')[0];

 dynamic_field(count);

 function dynamic_field(number)
 {
  
  html = '<tr>';
        html += '<input type="text" name="member_id[]" class="form-control" value="{{ $segment }}" readonly />';
        html += '<td><select data-skip-name="true" name="book_id[]" class="form-control chzn-select" style="width:350px;" tabindex="2" data-placeholder="Select book here..." required><option value=""></option>@foreach($book as $b)<option value="{{ $b->id }}">{{ $b->title }} ({{ $b->accessionno }}) - {{$b->author->name}}</option>@endforeach <input type="text" name="member_id[]" class="form-control" value="{{ $segment }}" readonly style="width:34px; display:none;" /></td>';
        html += '<td><input type="date" name="issueDate[]" class="form-control" value="{{ $today }}"/></td>';
        html += '<td><input type="date" name="retDate[]" class="form-control" value="' + formattedDefaultDate + '"/></td>';

        if(number > 1)
        { 
            html += '<td><button type="button" name="remove" id="remove" class="btn btn-danger remove"><i class="fa fa-trash"></i></button></td></tr>';
            $('tbody').append(html);
        }
        else
        {  
            html += '<td><button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button></td></tr>';
            $('tbody').html(html); 
        }

        updateAddButtonStatus();

 $("select").chosen({allow_single_deselect:true});
 }

 function updateAddButtonStatus() {
    var maxBooksAllowed = {{ $setting->no_of_books_per_member - $nos }};
    if (count >= maxBooksAllowed) {
        $('#add').prop('disabled', true);
    } else {
        $('#add').prop('disabled', false);
    }
  }
 
$('.selectpicker option:selected').val();

 $(document).on('click', '#add', function(){
  count++; 
  dynamic_field(count);
 });

 $(document).on('click', '#remove', function(){
  count--;
  $(this).closest("tr").remove();

  updateAddButtonStatus();
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