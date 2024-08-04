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
            <h1 class="m-0 text-dark">Issue Policies</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
              
              <li class="breadcrumb-item active">Issue Policies Settings</li>
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
        <div class="card-header bg-info"><h5>Issue Policies</h5></div>
          <div class="card-body text-dark">
            <form method="post" action="{{ route('settings.update.period',$setting->id) }}">
                @method('PUT')
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

             <div class="form-group">
                  <label>Maximum Borrowed Books Allowance per Member <span class="text-danger">(Including currently borrowed books)</span></label>
                  
                  <div class="input-icon">
                  <input type="decimal" class="form-control" name="perMember" placeholder="Enter the total number that a member is allowed to borrowed books as total" min="0" pattern="^[0-9]+(\.[0-9]{1,2})?$" value="{{ $setting->no_of_books_per_member }}" required></div>
                  <div class="clearfix"></div>
              </div>

              <div class="form-group">
                  <label>Loan Period for Borrowed Books <span class="text-danger">(In days)</span></label>
                  
                  <div class="input-icon">
                  <input type="number" class="form-control" name="lendingDays" placeholder="Enter duration of loan period of borrowed books in days" min="0" value="{{ $setting->no_of_days_for_lending }}" required>
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
