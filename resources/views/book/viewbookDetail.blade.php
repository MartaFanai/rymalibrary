@extends('layouts.admin')
@section('content')
@php
    use Carbon\Carbon;
@endphp
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

.card-header {
    background-color: #343a40; /* Dark background color */
    color: #ffffff; /* White text color */
    font-size: 1.5rem; /* Increase font size */
    font-weight: bold; /* Bold text */
    padding: 1rem 1.25rem; /* Add padding */
    position: relative; /* Position relative to handle z-index */
    margin: -2rem -1.25rem 1rem; /* Negative margin to pull header out */
    z-index: 1; /* Ensure it is above the card */
    border-radius: 0.25rem 0.25rem 0 0; /* Rounded corners at the top */
}

</style>
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Book Detail</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ '/home' }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('books.index') }}">Books</a></li>
              <li class="breadcrumb-item active">Book Detail</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
    	<div class="container-fluid">
            
            <div class="card book-detail-card col-sm-4 mx-auto">
              <div class="card-header mx-auto">
                {{ $book->title }}
              </div>
              @if(!is_null($borrow))
              <div class="col-sm-12 mx-auto">
                <center><strong><a href="{{ route ('returnBooks', $borrow->member_id) }}"> ( Return Now ) </a></strong></center>
                <br> 
                <strong class="float-right">Borrowed by :<a href="{{ route ('members.edit', $borrow->member_id) }}"> {{ $borrow->member->name }}</a></strong> <br>
                <span class="float-right">( Issued on : {{ Carbon::parse($borrow->issueDate)->format('d M Y') }} )</span>
              </div>
              @endif
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-3 text-right"><strong>Accession No :</strong></div>
                  <div class="col-sm-8 pl-3 pb-3">{{ $book->accessionno ?? 'N/A' }}</div>
                </div>

                <div class="row">
                  <div class="col-sm-3 text-right"><strong>Author :</strong></div>
                  <div class="col-sm-8 pl-3 pb-3">{{ $book->author->name }}</div>
                </div>

                <div class="row">
                  <div class="col-sm-3 text-right"><strong>Edition :</strong></div>
                  <div class="col-sm-8 pl-3 pb-3">{{ $book->edition ?? 'N/A' }}</div>
                </div>

                <div class="row">
                  <div class="col-sm-3 text-right"><strong>Volume :</strong></div>
                  <div class="col-sm-8 pl-3 pb-3">{{ $book->volume ?? 'N/A' }}</div>
                </div>

                <div class="row">
                  <div class="col-sm-3 text-right"><strong>Year :</strong></div>
                  <div class="col-sm-8 pl-3 pb-3">{{ $book->year ?? 'N/A' }}</div>
                </div>

                <div class="row">
                  <div class="col-sm-3 text-right"><strong>Publisher :</strong></div>
                  <div class="col-sm-8 pl-3 pb-3">{{ $book->publisher->name ?? 'N/A' }}</div>
                </div>

                <div class="row">
                  <div class="col-sm-3 text-right"><strong>Pages :</strong></div>
                  <div class="col-sm-8 pl-3 pb-3">{{ $book->pages ?? 'N/A' }}</div>
                </div>

                <div class="row">
                  <div class="col-sm-3 text-right"><strong>Source :</strong></div>
                  <div class="col-sm-8 pl-3 pb-3">{{ $book->source ?? 'N/A' }}</div>
                </div>

                <div class="row">
                  <div class="col-sm-3 text-right"><strong>Classification :</strong></div>
                  <div class="col-sm-8 pl-3 pb-3">{{ $book->classificationno ?? 'N/A' }}</div>
                </div>

                <div class="row">
                  <div class="col-sm-3 text-right"><strong>Subject :</strong></div>
                  <div class="col-sm-8 pl-3 pb-3">{{ $book->subject ?? 'N/A' }}</div>
                </div>

                <div class="row">
                  <div class="col-sm-3 text-right"><strong>Book No :</strong></div>
                  <div class="col-sm-8 pl-3 pb-3">{{ $book->bookno ?? 'N/A' }}</div>
                </div>

                <div class="row">
                  <div class="col-sm-3 text-right"><strong>Price :</strong></div>
                  <div class="col-sm-8 pl-3 pb-3">{!! $book->price ? '&#8377; ' . $book->price : 'N/A' !!}</div>
                </div>

                <div class="row">
                  <div class="col-sm-3 text-right"><strong>Source :</strong></div>
                  <div class="col-sm-8 pl-3 pb-3">{{ $book->description ?? 'N/A' }}</div>
                </div>
                
                <div class="row">
                  <div class="col-sm-3 text-right"><strong>Location :</strong></div>
                  <div class="col-sm-8 pl-3 pb-3">{{ $book->location ?? 'N/A' }}</div>
                </div>

                <div class="row">
                    <div class="col-sm-1 mx-auto">
                        <a href="#" class="btn btn-warning" onclick="window.history.back(); return false;"> <strong>Back</strong> </a>
                    </div>
                </div>
              </div>
            </div>
    		
</div>
</section>

@endsection