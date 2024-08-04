@extends('layouts.admin')
@section('content')

<div class="container">
<div class="row">
          
          <!-- /.col -->
          <div class="col-md-8 mt-5">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username">{{ $user->name }}</h3>
                <h5 class="widget-user-desc text-gray">@Marta's Library</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="{{ asset('storage/users/'.$user->image) }}" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{ $user->id }}</h5>
                      <span class="description-text">USER ID</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{ $user->email }}</h5>
                      <span class="description-text">EMAIL</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <?php 
                   $since = date('d-M-Y', strtotime($user->created_at));
                  ?>
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">{{ $since }}</h5>
                      <span class="description-text">SINCE</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div> <a href="{{ route('users.edit', $user->id) }}"><i class="fas fa-edit"></i></a> 
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
          <!-- /.col -->
          
          <!-- /.col -->
        </div>
</div>
@endsection