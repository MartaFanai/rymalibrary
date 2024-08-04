<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="{{ asset('storage/image/library_logo_red.png') }}">

        <title>Library</title>

        <!-- Fonts -->
        {{-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css"> --}}
        <link href="{{ route('google_api') }}" rel="stylesheet">

        <!-- Styles -->
        <style type="text/css">
        *{
            margin: 0;
            padding: 0;
            font-family: Century Gothic;
        }
        header{
            background-image:linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.6)), url('storage/image/landing.png');
            height: 100vh;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        ul{
            float: right;
            list-style-type: none;
            margin-top: 20px;
        }
        ul li{
            display: inline-block;
        }
        ul li a{
            text-decoration: none;
            color: #fff;
            padding: 5px 20px;
            border: 1px solid #fff transparent;
            transition: 0.3s ease;
        }
        ul li a:hover{
            background-color: #fff;
            color: #000;
        }
        .main{
            max-width: 1500px;
            margin: auto;
        }
        .title{
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%,-50%);
        }
        .title h1{
            color: #fff;
            font-size: 120px;
            font-family: Arial, Helvetica, sans-serif;
        }
        .sub-title{
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translate(-50%,-50%);
        }
        .sub-title h2{
            color: #fff;
            font-size: 42px;
            font-family:  'Trebuchet MS', Helvetica, sans-serif;
        }
        .logo img{
            width: 200px;
            height: auto;
            position: absolute;
            top: 65%;
            left: 50%;
            transform: translate(-50%,-50%);
        }
    </style>
    </head>
    <body>
        <header>
        <div class="main">
            @if (Route::has('login'))
            <ul>
                @auth
                    <li><a href="{{ url('/home') }}">Home</a> </li>
                @else
                    <li><a href="{{ route('login') }}">Login</a> </li>
                    <!-- <li><a href="{{ route('register') }}">Register</a> </li> -->
                    <li><a href="{{ route('checking') }}">Register</a> </li>
                @endauth
            </ul>
             @endif
        </div>
        <div class="title">
            <h1>LIBRARY</h1>
        </div>
        <div class="sub-title">
            <h2>Ramthar Veng Branch YMA</h2>
        </div>
        <div class="logo">
            {{-- <img src="storage\image\logo-color.png"> --}}
            <img src="storage\image\library_logo_red.png">
        </div>

    </header>
    </body>
</html>
