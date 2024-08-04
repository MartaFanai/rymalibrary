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
i{
    color: white;
}
</style>
<link rel="stylesheet" href="{{ asset('plugins/rateyo/jquery.rateyo.min.css') }}">



<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ratings of Members</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ '/home' }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Ratings of Members</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
            <?php $i = 1; $valid = date('Y'); ?>
    <section class="content">
    	<div class="container-fluid">
    		

    		<table class="table table-bordered table-striped table-hover" id="example1">
        <thead>
    			<tr>
    				<th>#</th>
    				<th>Name</th>
                    <th>Address</th>
    				<th>Star</th>
    				<th>Ratings</th>
    				<th>Member Since</th>
                    <th>Rate Auth</th>
                    <th>Status</th>
    			</tr>
         </thead>
            <tbody>
          @if(count($rating))
    			@foreach($rating as $r)
    			<tr>
    				<td>{{$i++}}</td>
    				<td>{{$r->name}}</td>
                    <td>{!! $r->address ? $r->address.'<br>'.$setting->id_address_default : $setting->id_address_default !!}</td>
    				<td><div id="rateyo" class="rateyo" data-rateyo-rating="{{$r->rating}}" data-rateyo-num-stars="5" data-rateyo-star-width="20px" data-rateyo-score="0" data-rateyo-read-only="true"></div></td>
    				<td>{{$r->rating}}</td>
                    <td>{{\Carbon\Carbon::parse($r->created_at)->format('Y') }}</td>
                    <td>{{$r->rating_user ?? 'Not yet rated'}}</td>
                    <td>@if($r->year >= $valid)
                            <span class="px-3 py-2 badge bg-success rounded-pill">Active Member</span>
                          @else
                            <span class="px-3 py-2 badge bg-danger rounded-pill">Inactive Member</span>
                          @endif
                    </td>
    			</tr>
                @endforeach
                 @else
                <tr><td colspan="8"><h4>No members found.</h4></td></tr>
                @endif
            </tbody>
    		</table>

            </div>

    	</div>
    </section>
  <!-- <script type="text/javascript" src="{{ asset('plugins/rateyo/jquery.min.js') }}"></script> -->
   <script type="text/javascript" src="{{ asset('plugins/rateyo/jquery.rateyo.min.js') }}"></script>

    <script type="text/javascript">
     $('#rateyo').rateYo({
        normalFill: 'grey',
        ratefill: 'yellow',
        }) 
     $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
    var rating = data.rating;
    $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
    $(this).parent().find('.result').text('Rating :'+ rating);
    if(rating >= 0)
    {
      document.getElementById('rating').value = rating;
    }
    
   });

  </script>

    <script>
     
        $("#example1").dataTable();

        $(document).ready(function(){

        $('#myModal').on('show.bs.modal', function (e) {
            var id = $(e.relatedTarget).data('id');
            var url = "{{ route('members.destroy', ':id') }}";
            url = url.replace(':id', id);

            document.getElementById('deleteBtn').action = url;
        });

        
    });
   
    </script>
   
@endsection