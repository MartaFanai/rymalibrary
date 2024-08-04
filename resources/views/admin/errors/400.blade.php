@extends('layouts.admin')
@section('content')
<style type="text/css">
  input[type="number"] {
  -moz-appearance: textfield;
}
input[type="number"]::-webkit-inner-spin-button, 
input[type="number"]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}

</style>
{{-- Page Header Section --}}
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        {{-- <h1 class="m-0 text-dark">Page Name Here</h1> --}}
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">ERROR 400</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

{{-- Page Main Content --}}
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="{{ $shopsDetail->size ?? 'col-md-9' }} mx-auto">

        <div class="card border-0 shadow-lg">

          <div class="card-header {{ isset($shopsDetail->colors) ? $shopsDetail->colors : 'bg-gray' }} text-white">
            <h5 class="card-title mb-0">ERROR 400</h5>
          </div>

          <div class="card-body">

            <div class="error-page">
              <h2 class="headline text-danger"> 400</h2>

              <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-warning"></i>UNAUTHORIZE USER DETECTED</h3>

                <p>
                  If you want to use this software. Contact the developer in person using whatsapp or phone call or text message at: 9856929319 / 7005815637. Please do follow proper procedures in life. 
                </p>

                <p>
                  <i>You need to get in touch with the software developer. Please feel free to call and start business together.</i>
                </p>
              </div>
              <!-- /.error-content -->
            </div>
            <!-- /.error-page -->
              
          
          </div>

        </div>

      </div>
    </div>
  </div>
</section>
@endsection