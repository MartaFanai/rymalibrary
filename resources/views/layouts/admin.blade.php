<!DOCTYPE html>
<html>
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style type="text/css">
    
.modal-confirm {        
        color: #636363;
        width: 400px;
    }
    .modal-confirm .modal-content {
        padding: 10px;
        border-radius: 5px;
        border: none;
        text-align: center;
        font-size: 16px;
    }
    .modal-confirm .modal-header {
        border-bottom: none;   
        position: relative;
        display: inline-block;
    }
    .modal-confirm h4 {
        text-align: center;
        font-size: 26px;
        margin: 10px 0 -10px;
    }
    .modal-confirm .close {
        position: absolute;
        top: -5px;
        right: -2px;
    }
    .modal-confirm .icon-box {
        width: 80px;
        height: 80px;
        margin: 0 auto;
        border-radius: 50%;
        z-index: 9;
        text-align: center;
        border: 3px solid #f15e5e;
    }
    .modal-confirm .icon-box i {
        color: #f15e5e;
        font-size: 46px;
        display: inline-block;
        margin-top: 13px;
    }
    .modal-confirm .modal-body {
        color: #999;
    }
    .modal-confirm .modal-footer {
        border: none;
        text-align: center;     
        border-radius: 5px;
        font-size: 13px;
        display: inline-block;
        color: white;
        /*padding: 10px 15px 25px;*/
    }     

  </style>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <link rel="icon" type="image/jpg" href="{{ asset('storage/image/logo_black.jpg') }}">

  <title>Marta's Library</title>

  <!-- Backup JS import -->
  <script src="{{ asset('js/globalBackup.js') }}"></script>

  <!-- Link for choosen js for multiple select item -->
 
  <link rel="stylesheet" href="{{ asset('choosen/docsupport/prism.css') }}">
  <link rel="stylesheet" href="{{ asset('choosen/chosen.css') }}">
  
  {{-- <script type="text/javascript" src="{{ asset('chosen/chosen.jquery.js') }}"></script> --}}

  <!-- Sweetalert2 import -->
  <script type="text/javascript" src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('dist/js/adminlte.min.js') }}"></script>

  

  <!-- Important script downloaded -->
  <script type="text/javascript" src="{{ asset('plugins/download-files/jquery-3.1.1.slim.min.js') }}"></script>

  <script type="text/javascript" src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
  <script type="text/javascript" src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
  

  <link rel="stylesheet" href="{{ asset('css/fstdropdown.css') }}">
  <script type="text/javascript" src="{{ asset('js/fstdropdown.js') }}"></script>

  <!-- {{-- Cropper class  --}} -->
  <script type="text/javascript" src="{{ asset('js/cropper.min.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('css/cropper.min.css') }}">

  <link rel="stylesheet" href="{{ asset('css/bootstrap-select.css') }}">
  <script type="text/javascript" src="{{ asset('js/bootstrap-select.js') }}"></script>

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> 
  <link rel="stylesheet" href="{{ route('ionicons.css') }}"> -->

  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">

  <!-- Google Font: Source Sans Pro -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
  <link href="{{ route('google_fonts') }}" rel="stylesheet">
  <link href="{{ route('material_icons') }}" rel="stylesheet"> -->

</head>
<script>

    function openNav() {
      document.getElementById("body").className = "hold-transition sidebar-mini layout-fixed sidebar-collapse";
      var element = document.getElementById("bar");
      element.setAttribute( "onClick", "javascript: closeNav();" );
    } 
    function closeNav() {
      document.getElementById("body").className = "hold-transition sidebar-mini layout-fixed";
      var element = document.getElementById("bar");
      element.setAttribute( "onClick", "javascript: openNav();" );
    }                                                   

</script>
{{-- This line opens menu tab --}}
{{-- <body id="body" class="hold-transition sidebar-mini layout-fixed"> --}}
  {{-- THis line close menu tab and open when hover =>if enable change anchor onclick="closeNav()" --}}
<body id="body" class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a id="bar" class="nav-link" data-widget="pushmenu" type="submit" onclick="closeNav()"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ Route('home') }}" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link" data-toggle="modal" data-target="#myContact">Contact</a> 
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input id="myInput" class="form-control form-control-navbar" type="search" placeholder="Menu Search" aria-label="Search" autocomplete="off">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
  
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{ asset('storage/image/logo_black.jpg') }}" alt="ML Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">MARTA'S Library</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('storage/users/'.Auth::user()->image) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ route('profile',Auth::user()->id) }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <div id="myDIV">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                
              <?php
                 $segment = Request::segment(1); 
              ?>

          <li class="nav-item">
            <a href="{{ Route('home') }}" class="nav-link
                                                  @if($segment == 'home')
                                                    active
                                                  @endif">

              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
            
          </li>
          <li class="nav-item">
            <a href="{{ Route('books.index') }}" class="nav-link
                                                  @if($segment == 'books' || $segment == 'book')
                                                    active
                                                  @endif">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Books
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview @if($segment == 'issue' || $segment == 'return' || $segment == 'retBybook' || $segment == 'receipt' || $segment == 'report' || $segment == 'code' || $segment == 'retreport' || $segment == 'stat')
                                                    menu-open
                                                  @endif">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book-open"></i>
              <p>
                Circulation of Library
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ Route('issue') }}" class="nav-link
                                                  @if($segment == 'issue')
                                                    active
                                                  @endif">
              <i class="nav-icon fas fa-book-medical"></i>
              <p>
                Issue Section
              </p>
            </a>
              </li>
              <li class="nav-item">
                <a href="{{ Route('return') }}" class="nav-link
                                                  @if($segment == 'return' || $segment == 'retBybook')
                                                    active
                                                  @endif">
                    <i class="nav-icon fas fa-exchange-alt"></i>
                  <p>
                    Return Section
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ Route('code') }}" class="nav-link
                                                  @if($segment == 'code')
                                                    active
                                                  @endif">
                    <i class="nav-icon fas fa-barcode"></i>
                  <p>
                    Print Book Code
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ Route('receipt') }}" class="nav-link
                                                  @if($segment == 'receipt')
                                                    active
                                                  @endif">
                    <i class="nav-icon fas fa-tasks"></i>
                  <p>
                    Receipt Check
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ Route('report') }}" class="nav-link
                                                  @if($segment == 'report' || $segment == 'retreport')
                                                    active
                                                  @endif">
                    <i class="nav-icon fas fa-poll"></i>
                  <p>
                    Report
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ Route('stat') }}" class="nav-link
                                                  @if($segment == 'stat')
                                                    active
                                                  @endif">
                    <i class="nav-icon fas fa-file-medical-alt"></i>
                  <p>
                    Register
                  </p>
                </a>
              </li>
              
            </ul>
          </li>

          <li class="nav-item has-treeview @if($segment == 'members' || $segment == 'generateid' || $segment == 'rating' || $segment == 'inactive' || $segment == 'validity')
                                                    menu-open
                                                  @endif">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Member Management
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ Route('members.index') }}" class="nav-link
                                                      @if($segment == 'members' || $segment == 'validity')
                                                        active
                                                      @endif">
                  <i class="nav-icon fas fa-user-friends"></i>
                  <p>
                    Member
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ Route('generateid') }}" class="nav-link
                                                  @if($segment == 'generateid')
                                                    active
                                                  @endif">
                    <i class="nav-icon fas fa-id-card"></i>
                  <p>
                    ID Card
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ Route('rating', 1) }}" class="nav-link
                                                  @if($segment == 'rating')
                                                    active
                                                  @endif">
                    <i class="nav-icon fas fa-star-half-alt"></i>
                  <p>
                    Rating List
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ Route('inactive', 1) }}" class="nav-link
                                                  @if($segment == 'inactive')
                                                    active
                                                  @endif">
                    <i class="nav-icon fas fa-user-alt-slash"></i>
                  <p>
                    Inactive Members
                  </p>
                </a>
              </li>
              
            </ul>
          </li>

        @if(!(Auth::user()->role))
          <li class="nav-item has-treeview @if($segment == 'period' || $segment == 'fines' || $segment == 'user' || $segment == 'printcode' || $segment == 'idPrefix' || $segment == 'author' || $segment == 'publisher' || $segment == 'deactivate')
                                                    menu-open
                                                  @endif">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ Route('authors.index') }}" class="nav-link
                                                      @if($segment == 'author')
                                                        active
                                                      @endif">
                  <i class="nav-icon fas fa-user-edit"></i>
                  <p>
                    Author
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ Route('publishers.index') }}" class="nav-link
                                                  @if($segment == 'publisher')
                                                    active
                                                  @endif">
                    <i class="nav-icon fas fa-object-group"></i>
                  <p>
                    Publisher
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ Route('settings.user') }}" class="nav-link
                                                  @if($segment == 'user')
                                                    active
                                                  @endif">
                    <i class="nav-icon fas fa-user-tag"></i>
                  <p>
                    User Role
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ Route('deactivate') }}" class="nav-link
                                                  @if($segment == 'deactivate')
                                                    active
                                                  @endif">
                    <i class="nav-icon fas fa-user-clock"></i>
                  <p>
                    Cancel Membership
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ Route('settings.idPrefix') }}" class="nav-link
                                                  @if($segment == 'idPrefix')
                                                    active
                                                  @endif">
                    <i class="nav-icon fas fa-code"></i>
                  <p>
                    Default ID Value 
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ Route('settings.period') }}" class="nav-link
                                                  @if($segment == 'period')
                                                    active
                                                  @endif">
                    <i class="nav-icon fas fa-receipt"></i>
                  <p>
                    Issue Policies
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ Route('settings.fines') }}" class="nav-link
                                                  @if($segment == 'fines')
                                                    active
                                                  @endif">
                    <i class="nav-icon fas fa-money-check-alt"></i>
                  <p>
                    Late Fees
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ Route('settings.printcode') }}" class="nav-link
                                                  @if($segment == 'printcode')
                                                    active
                                                  @endif">
                    <i class="nav-icon fas fa-clipboard-list"></i>
                  <p>
                    Print Code Count
                  </p>
                </a>
              </li>
              
            </ul>
          </li>
          @endif

          @if($numbers > 0 || $booksToUpload > 0)
                @php $style = 'color: #dc3545;'; @endphp
          @else
              @php $style = 'color: none;'; @endphp
          @endif

          <li class="nav-item has-treeview @if($segment == 'backup')
                                                    menu-open
                                                  @endif">
          <a href="#" class="nav-link">
              <!-- <i class="nav-icon fas fa-database" style="{{$style}}"></i> -->
              <i class="nav-icon fas fa-database"></i>
              <p style="padding-right: 10px;">
                Database
                <i class="fas fa-angle-left right"></i>
              </p>
              {{-- @if($numbers > 0 || $booksToUpload > 0)
                <span class="badge badge-danger"> {{ $numbers + $booksToUpload }}</span>
              @endif --}}
          </a>
          <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="#" data-action="backup" data-url="{{ Route('backup') }}" class="nav-link">

              <i class="nav-icon fas fa-download"></i>
              <p>
                Back Up
              </p>
            </a>
            
          </li>

          @php
            // Get all backup files from the directory
            $files = Storage::files('backups/Marta-s-Library');

            // Get the latest backup file (assuming files are named in a way that lexicographically sorts them by date)
            $latestFile = collect($files)->sort()->last();

            if ($latestFile) {
                // Extract the filename
                $filename = basename($latestFile);

                // Extract the date from the filename
                $dateString = substr($filename, 0, 10); // 2024-07-30

                // Parse the date string using DateTime
                $date = DateTime::createFromFormat('Y-m-d', $dateString);

                // Format the date
                $formattedDate = $date->format('d-m-Y');
            }
          @endphp

          @if(isset($latestFile))
          <li class="nav-item">
            <a href="{{ route('download-backup') }}" class="nav-link">

              <i class="nav-icon fas fa-cloud-download-alt"></i>
              <p>
                Download ({{$formattedDate}})
              </p>
            </a>
            
          </li>
          @endif

          @if($booksToUpload > 0)
            @php $class = 'nav-link'; $style = 'color: #ffc107;'; @endphp
          @else
            @php $class = 'nav-link disabled'; $style = 'color: none;'; @endphp
          @endif

          {{-- <li class="nav-item">
            <a href="{{ Route('list') }}" class="{{$class}}" id="sync">
              <i class="nav-icon fas fa-sync" style="{{$style}}"></i>
              <p>
                Sync DB (Internet req.) <span class="badge badge-warning right">{{ $booksToUpload }}</span>
              </p>
            </a>
          </li> --}}


          @if($numbers > 0)
            @php $class = 'nav-link'; $style = 'color: #28a745;'; @endphp
          @else
            @php $class = 'nav-link disabled'; $style = 'color: none;'; @endphp
          @endif

          
          {{-- <li class="nav-item">
            <a href="#" class="{{$class}}" id="downloadCsv" onclick="downloadAndReload()">
              <i class="nav-icon fas fa-file-export"  style="{{$style}}"></i>
              <p>
                Extract Online CSV <span class="badge badge-success right">{{ $numbers }}</span>
              </p>
            </a>
          </li> --}}

          <!-- <li class="nav-item">
            <a href="{{ Route('localbackup') }}" class="nav-link">

              <i class="nav-icon fas fa-database"></i>
              <p>
                Local Back Up
              </p>
            </a>
            
          </li> -->
        </ul>
      </li>
          <li class="nav-header">ACCOUNTS</li>
          <li class="nav-item">
             <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-power-off text-danger"></i>
                                    <p>
                   Logout
                  </p>
            </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
              </form>
          </li>
          
        </ul>
      </nav>
    </div>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    @include('sweetalert::alert')
    
    @yield('content')

    <!-- Loading Screen HTML -->
    <div id="loading-screen" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); color:white; text-align:center; padding-top:20%; z-index:1000;">
        <h2>Please wait...</h2>
    </div>

    <!-- CSRF Token Meta Tag -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

  </div>

    <!-- The Contact Modal -->
<div class="modal" id="myContact">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal body -->
      <div class="modal-body">
        <div class="wrap">
          <div class="cls">
              <a type="button" class="closed" data-dismiss="modal">x</a>
          </div>
          <div class="Title">
            Contact
          </div>
          <div class="dev">
            <b>Developer</b><br>F. Vanlalruata<br>Ramthar Veng<br>martafanai8@gmail.com<br>9856929319
          </div>
          <div class="cont">
            <p class="info">This Library Software is specially designed for Ramthar Veng Branch YMA in the year 2020 for maintaining and digitalized its existing transaction.</p>
            <p class="res">Distribution of this software in any kind<br> is not allowed. </p>
          </div> 
          
        </div>  
      </div>


    </div>
  </div>
</div>

<style type="text/css">
 
  .wrap{
    font-family: Century Gothic;
    height: 50vh;
    background-color: #79c4db;
    border-radius: 5px;
  }
  .closed{
    max-width: 10px;
    position: absolute;
    top: 3%;
    left:93%;
    font-size: 20px;
    color: white;
  }
  .Title{
    position: absolute;
    top: 10%;
    left: 50%;
    transform: translate(-50%,-50%);
    font-size: 30px;
    font-weight: bold;
    font-style: normal;
    font-family: Century Gothic;
    color: #000;
  }
  .cont{
    position: absolute;
    top: 45%;
    left: 10%;
    max-width: 410px;
    font-size: 18px;
  }
  .info{
    text-align: justify;
  }
  .res{
    font-weight: bold; 
    text-align: center;
  }
  .dev{
    position: absolute;
    top: 18%;
    left: 35%;
    text-align: center;
    font-size: 12px;
  }

</style>
  <!-- /.content-wrapper -->
  @php
    $cur_year = Carbon\Carbon::now()->format('Y');
  @endphp
  <footer id="printPageButton" class="main-footer">
    <strong>Copyright &copy; 2024 @if(2024 < $cur_year ) - {{ Carbon\Carbon::now()->format('Y') }} @endif &nbsp; &nbsp; Ramthar Veng Branch YMA</strong>
    &nbsp; &nbsp;All rights reserved
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script> 
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
<script src="{{ asset('js/repeater.js') }}"></script>
<script src="{{ asset('js/fstdropdown.js') }}"></script>

<!-- ink for choosen js for multiple select item -->

  <script src="{{ asset('choosen/chosen.jquery.js') }}" type="text/javascript"></script>
  <script src="{{ asset('choosen/docsupport/prism.js') }}" type="text/javascript" charset="utf-8"></script>
  <script src="{{ asset('choosen/docsupport/init.js') }}" type="text/javascript" charset="utf-8"></script>

  <script type="text/javascript">

  jQuery("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    jQuery("#myDIV *").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

  function downloadAndReload() {
        window.location.href = '{{ route("downloadCsv") }}';
        setTimeout(function() {
            location.reload();
        }, 1000); // Reload the page after 1 second (adjust as needed)
    }

</script>
</body>
</html>
