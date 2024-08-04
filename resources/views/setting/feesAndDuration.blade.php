@extends('layouts.admin')
@section('content')

<style type="text/css">
  .input-icon { 
    position: relative;
  }

  .input-icon > i {
    position: absolute;
    display: block;
    transform: translate(0, -50%);
    top: 50%;
    pointer-events: none;
    width: 25px;
    text-align: center;
    font-style: normal;
  }

  .input-icon > input {
    padding-left: 25px;
    padding-right: 0;
  }

  .input-icon-right > i {
    right: 0;
  }

  .input-icon-right > input {
    padding-left: 0;
    padding-right: 25px;
    text-align: right;
  }

</style>

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Late Fees</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
              
              <li class="breadcrumb-item active">Late Fee Settings</li>
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
        <div class="card-header bg-info"><h5>Late Fees</h5></div>
          <div class="card-body text-dark">
            <?php
              $durationMap = [

                  0 => 'Daily',
                  1 => 'Weekly',
              ];
            ?>
            <form method="post" action="{{ route('settings.update.fines',$setting->id) }}">
                @method('PUT')
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

             <div class="form-group">
                  <label>Late Fees Charge Duration</label>
                  
                    <select name="fees_duration" class="form-control col-4" required>
                          <option value="{{ $setting->fees_duration }}"> {{ $durationMap[$setting->fees_duration] }} </option>
                          <option disabled> -Select Duration- </option>
                          <option value="0"> Daily </option>
                          <option value="1"> Weekly </option>
                    </select>
                  
             </div>

             <div class="form-group">
                  <label>Late Fees per Day <span class="text-danger">(Minimum 0. Allow up to 2 Decimal Places indicating paise.)</span></label>
                  
                  <div class="input-icon">
                  <input type="decimal" class="form-control" name="fees" placeholder="Enter your new Late Fee Rate per day" min="0" pattern="^[0-9]+(\.[0-9]{1,2})?$" value="{{ $setting->fees }}" required><i>&#8377;</i></div>
                  <div class="clearfix"></div>
              </div>

              <!-- <div class="form-group">
                  <label>Duration of lending books (in days)</label>
                  
                  <div class="input-icon">
                  <input type="number" class="form-control" name="duration" placeholder="Enter duration of lending books in days" min="0" value="{{ $setting->duration }}" required>
                  <div class="clearfix"></div>
              </div> -->

        </div>

            <div class="card-footer">
                  <div class="form-group">
                  <label></label>    
                  <input type="submit" class="btn btn-info" value="Update">
              </div>  
      </div>               
            </form>
      </div>
    </div>
</section>
@endsection
