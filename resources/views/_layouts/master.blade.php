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
 
   

  <!-- User Menu-->
  <ul class="app-nav">



                        <!-- Authentication Links -->
                        @guest



              
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <button class="btn btn-primary" type="button">Login</button>
                           <div class="btn-group" role="group">
                             <button class="btn btn-primary dropdown-toggle" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                  <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="{{ route('userChange',11) }}">Michael</a>
                  <a class="dropdown-item" href="{{ route('userChange',14) }}">Chris</a>
                  <a class="dropdown-item" href="{{ route('userChange',3) }}">Craig</a>
                  <a class="dropdown-item" href="{{ route('userChange',4) }}">Joe</a>
                  <a class="dropdown-item" href="{{ route('userChange',8) }}">Daniel</a>
                  <a class="dropdown-item" href="{{ route('userChange',6) }}">Thomas</a>
                  <a class="dropdown-item" href="{{ route('userChange',5) }}">Marie</a>
                  <a class="dropdown-item" href="{{ route('userChange',7) }}">Mark</a>
                  <a class="dropdown-item" href="{{ route('userChange',9) }}">Jennifer</a>
                  <a class="dropdown-item" href="{{ route('userChange',10) }}">Alan</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#loginModal" data-toggle="modal" data-target="#loginModal">Tim (admin)</a>
                      <a class="dropdown-item" href="#loginModal" data-toggle="modal" data-target="#loginModal">Pete (admin)</a>
                  <a class="dropdown-item" href="#loginModal" data-toggle="modal" data-target="#loginModal">John (admin)</a>
                               <a class="dropdown-item" href="#loginModal" data-toggle="modal" data-target="#loginModal">Paul (admin)</a>
  
        
          
                  </div>
                </div>
              </div>


           

     @else

            
            
    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <button class="btn btn-primary" type="button">{{ Auth::user()->name }}</button>
                           <div class="btn-group" role="group">
                             <button class="btn btn-primary dropdown-toggle" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                  <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('userChange',11) }}">Michael</a>
                      <a class="dropdown-item" href="{{ route('userChange',14) }}">Chris</a>
                  <a class="dropdown-item" href="{{ route('userChange',3) }}">Craig</a>
                  <a class="dropdown-item" href="{{ route('userChange',4) }}">Joe</a>
                  <a class="dropdown-item" href="{{ route('userChange',8) }}">Daniel</a>
                  <a class="dropdown-item" href="{{ route('userChange',6) }}">Thomas</a>
                  <a class="dropdown-item" href="{{ route('userChange',5) }}">Marie</a>
                  <a class="dropdown-item" href="{{ route('userChange',7) }}">Mark</a>
                  <a class="dropdown-item" href="{{ route('userChange',9) }}">Jennifer</a>
                  <a class="dropdown-item" href="{{ route('userChange',10) }}">Alan</a>
                  <div class="dropdown-divider"></div>
                   <a class="dropdown-item" href="#loginModal" data-toggle="modal" data-target="#loginModal">Tim (admin)</a>
                        <a class="dropdown-item" href="#loginModal" data-toggle="modal" data-target="#loginModal">Pete (admin)</a>
                  <a class="dropdown-item" href="#loginModal" data-toggle="modal" data-target="#loginModal">John (admin)</a>
                              <a class="dropdown-item" href="#loginModal" data-toggle="modal" data-target="#loginModal">Paul (admin)</a>
  
  
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ route('userLogout') }}">Logout</a>
                </div>
                </div>
              </div>


</ul>

















                 
                        
                        @endguest
                    
    </header>


  
    
    
    <main class="app-content">

   
          
            @include('_layouts.sidebar')

            @yield('content')

    @include('_layouts.footer')


<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title center" id="exampleModalLongTitle"><center>Admin Login</center></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      
        
        {!!Form::open(array('route'=>['admin'],'method'=>'GET', 'style'=>'margin: 1px 1px 1px 1px'))!!}
  
 

     <div class='form-row col md-12'>
    
        <div class='form-group col md-12'>

     {{Form::label('email', 'Email:')}}
    
     {{Form::text('email',NULL,  array('class' => 'form-control'))}}

  
     </div></div>

     <div class='form-row col md-12'>
            <div class='form-group col md-12'>
   
      {{Form::label('password', 'Password:')}}
    
      {{ Form::password('password', array('id' => 'password', "class" => "form-control", "autocomplete" => "off")) }}
 
  
     </div></div>


<div class="modal-footer">
</div>



    <center>
        {!! Form::button('Login', ['class'=>'btn btn-primary', 'type'=>'submit']) !!}
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button></center>
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>  
<!-- Modal END-->




</body>

</html>