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
            <h1 class="m-0 text-dark">Member Validity</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('members.index') }}">Members</a></li>
              <li class="breadcrumb-item active">Member Validity</li>
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
        <div class="card-header bg-info"><h5>Member Validity</h5></div>
          <div class="card-body text-dark">
            <form method="post" action="{{ route('update.validity', $member->id) }}">
                @method('PUT')
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

             <div class="form-group">
                  <label>Membership valid untill</label>
                  
                  <div class="input-icon">
                  <input type="number" class="form-control" name="years" placeholder="Enter your new Late Fee Rate per day" min="0" pattern="^[0-9]+(\.[0-9]{1,2})?$" value="{{ $member->year }}" readonly></div>
                  <div class="clearfix"></div>
              </div>

              <div class="form-group">
                  <label for="membershipExtension">How many years do you want to extend this membership</label>

                  <div class="input-group">
                      <select class="form-control" id="membershipExtension" name="membershipExtension">
                          <option value="0">None</option>
                          <option value="1">1 Year</option>
                          <option value="2">2 Years</option>
                          <option value="3">3 Years</option>
                          <option value="4">4 Years</option>
                          <option value="5">5 Years</option>
                          <option value="6">6 Years</option>
                          <option value="7">7 Years</option>
                          <option value="8">8 Years</option>
                          <option value="9">9 Years</option>
                          <option value="10">10 Years</option>
                      </select>
                      <div class="input-group-append">
                          <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                      </div>
                  </div>
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
