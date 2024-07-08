@include('config.functions')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{asset('imgs/logo.png')}}" type="image/x-icon" >

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
     {{--## created NamePage() so i dont have to type this over n over  --}}
    {{-- <title>{{ ucfirst( pathinfo($_SERVER['PHP_SELF'])["filename"] ) }} | Care pharmacy </title> --}}
    <title> {{NamePage($_SERVER["PHP_SELF"])}} | Care Pharmacy </title>

    {{------ Fnt Awesome --------}}
    <link rel="stylesheet" href="{{asset('style/all.min.css')}}">

    {{------ CSS --------}}
    <link rel="stylesheet" href="{{asset('style/General.css')}}">
    <link rel="stylesheet" href="{{asset('style/style.css')}}">
</head>
<body>

<header>
    <div class="container">
        <div class="header-box">
            
            <form action="{{route('logout')}}" id="Logout" >
                <button type="submit"> Log out </button>
            </form>

            <section class="logo">
                <a  href ="{{route('home')}}"  class="sys">
                    <div class="sys-logo"></div>
                    <div class="sys-name"><span>Care</span> Pharamcy</div>
                </a>
            </section>

            <section class="search">
                <form action="{{route('DrugsSearch')}}">
                    <input placeholder="Enter a drug name" type="search" name="headSearch" id="" value="{{request('headSearch')}}">
                </form>

            </section>
    
        </div>
    </div>
</header>
@include('subviews.navbar')


