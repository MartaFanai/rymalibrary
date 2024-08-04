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
            <h1 class="m-0 text-dark">Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Default ID Value Settings</li>
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
        <div class="card-header bg-info"><h5>Edit Default ID Value</h5></div>
          <div class="card-body text-dark">
            <form method="post" action="{{ route('settings.update.idPrefix',$prefix->id) }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

             <div class="form-group">
                  <label>Default Prefix for your Member ID <span class="text-danger">(eg. ML/{year}/{id_number})</span></label>
                  
                  <div class="input-icon">
                  <input type="text" class="form-control" name="prefix" placeholder="Enter the prefix you want to use" value="{{ $prefix->id_code_prefix }}" required></div>
                  <div class="clearfix"></div>
              </div>

               <?php
                  $capacityMap = [
                      2 => '100 Member',
                      3 => '1,000 Member',
                      4 => '10,000 Member',
                      5 => '100,000 Member'
                  ];
               ?>

              <div class="form-group">
                  <label>Default Membership Capacity Per Year <span class="text-danger">(eg. ML/2024/<u>001</u> | It will change the leading zeros)</span></label>
                  
                    <select name="capacity" class="form-control col-12" required>
                          <option value="{{ $prefix->id_capacity }}">{{ $capacityMap[$prefix->id_capacity] }}</option>
                          <option disabled> ---------------- </option>
                          <option value="2"> 100 Member </option>
                          <option value="3"> 1,000 Member </option>
                          <option value="4"> 10,000 Member </option>
                          <option value="5"> 100,000 Member </option>
                    </select>
             </div>

              <div class="form-group">
                  <label>Default ID Address <span class="text-danger">(eg. Ramthar Veng, Aizawl, Mizoram)</span></label>
                  
                  <div class="input-icon">
                  <input type="text" class="form-control" name="address" placeholder="Enter the default address you want to use" value="{{ $prefix->id_address_default }}"></div>
                  <div class="clearfix"></div>
              </div>


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
