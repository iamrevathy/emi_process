<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

   

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .container {
            min-height: 100%;
            position: relative;
            padding-bottom: 60px; /* Adjust this value to set the footer height */
        }
        

        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px; /* Adjust this value to set the footer height */
            background-color: #f2f2f2;
            text-align: center;
            padding: 20px;
        }
        
        /* Add your custom styles here */

        header {
            background-color: #f2f2f2;
            padding: 20px;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: flex-end;
        }

        nav ul li {
            margin-right: 10px;
          
        }

        nav ul li a {
            text-decoration: none;
            color: blue;
            
        }
    
    </style>

</head>
<body>
<header>
        <nav>
            <!-- Add your navigation bar code here -->
            <ul>
            @if(Route::is('home'))
              <a href="{{ route('login') }}">Login</a>
                @endif

                @if(Route::is('loan-details'))
              <a href="{{ route('process.data') }}">Process</a>
                @endif
                <!-- <li><a href="{{ route('login') }}">Login</a></li> -->
                
               
            </ul>
        </nav>
    </header>

    <div id="app">
      
    

        <main class="py-4">
            @yield('content')
        </main>
        <footer>
       
        <p>&copy; {{ date('Y') }} Your Laravel App. All rights reserved.</p>
    </footer>
    </div>
</body>
</html>
