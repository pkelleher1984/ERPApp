<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
   
    <link rel="icon" href="../../../../favicon.ico">
@section('head')


@show
    <title>ERP App</title>

    <!-- Bootstrap core CSS -->


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

 <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>


<link rel="stylesheet" type="text/css" href="/css/main.css">

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">




    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">
  </head>





  <body class="app sidebar-mini rtl">


<header class="app-header"><a class="app-header__logo" href="#"><img src="/images/iew-logo.png" height="35" style="padding-right:""> ERP v1.0</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
     
  
        <!--Notification Menu-->
        <!-- User Menu-->
      
      </ul>
    </header>



    
    

    <main class="app-content">

    	
          
            @include('_layouts.sidebar')

            @yield('content')

    @include('_layouts.footer')

  </body>

</html>
