<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>E-Shopper 9000</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo asset('css/styles.css')?>" type="text/css">
    <script src="https://code.jquery.com/jquery-3.2.1.js"   integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="   crossorigin="anonymous"></script>

    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }
        .contentLocation{
            padding: 10px;
        }

        .btn-link{
            color: black;
        }

        .fa-btn {
            margin-right: 6px;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        th  {
            padding-left: 2px;
            padding-right: 2px;
            background-color: darkslategray;
            border: 1px solid darkslategray;
            color: white;
            text-align: center;
        }

        td{
            padding-left: 2px;
            padding-right: 2px;
            border-left: 1px solid darkslategray;
            border-right: 1px solid darkslategray;
        }

        tr:nth-child(odd) {  background-color: lightslategray;  }

        .Alert{
            padding: 10px;
            border-radius: 5px;
        }
        .Alert--error{
            background: Red;
            color: white;
        }
        .Alert--success{
            background: Green;
            color: white;
        }
        .shopping-cart{
            float: right;
            padding-right: 10%;
        }
    </style>

    <script>
        var currentProduct;
        var quantity = 0;
        var Available = "Add to Cart";

        function clickProduct(currentProduct){
            quantity = currentProduct.quantity;
            var ul = document.getElementById("list");
            var items = ul.getElementsByTagName("li");
            for (var i = 0; i < items.length; i++) {
                if(items[i].innerText == currentProduct.name && i == items[i].value){
                    items[i].classList.add("active");
                }
                else {
                    items[i].classList.remove("active");
                }
            }

            $('#product').html("");
            $('#product').html("<p>Product: " + currentProduct.name + "</p>" +
                    "<p>$" + currentProduct.price + "</p>" +
                    "<p>In Stock: " + currentProduct.quantity + "</p>" +
                    "<p>Description: " + currentProduct.description + "</p>" +
                    "<p>Quantity:  " + "<input type='text' style='width: 25px;'> </input> </p>" +
                    "<button class='btn btn-success' onclick='addToCart();'> Add to Cart");
        }

        function addToCart(){

        }

        function filter() {
            // Declare variables
            var input, filter, item, ul, li, i;
            input = document.getElementById('search');
            filter = input.value.toUpperCase();
            ul = document.getElementById("list");
            li = ul.getElementsByTagName('li');

            // Loop through all list items, and hide those who don't match the search query
            for (i = 0; i < li.length; i++) {
                item = li[i];
                if (item.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        }
    </script>

</head>
<body id="app-layout">
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                E-Shopper 9000
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/home') }}">Home</a></li>
                <li><a href="{{ url('/products') }}">Products</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Select Store <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            @foreach($stores as $store)
                                <li><a href="{{ url('/products?store=' . $store->name) }}">{{$store->name}}</a></li>
                            @endforeach
                        </ul>

                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->FirstName }} {{ Auth::user()->LastName }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/cart') }}"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> Logout</a></li>
                        </ul>

                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<!-- JavaScripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
