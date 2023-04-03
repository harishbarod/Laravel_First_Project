<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'IQ Tester') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- <script src="{{ asset('js/chat.js') }}" defer></script> --}}
   

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
   
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/chat.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/b250bfe91b.js" crossorigin="anonymous"></script>
    
</head>
<body>
   @yield('question_css')
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'IQ Tester') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                                
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        {{-- <a href="{{ url('forget-password') }}" class="btn btn-information">Forget password</a> --}}

                        <style>
                            #user_img{
                                width: 50px;
                                height: 50px;
                            }
                            #user_img img{
                                width: 50px;
                                height: 50px;
                                border-radius: 3rem;
                            }
                        </style>
                             <div id="user_img" id="question_img"> 
                                @php $img ="1660900136.jpg" @endphp
                                
                                <img src="{{ Auth::user()->image ?asset('images/'.Auth::user()->image) : asset('images/question/'.$img) }}" alt="" class="img-fluid">
                
                               </div>
                    
                            <li class="nav-item dropdown">
                               
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    
                                    {{ Auth::user()->name }}
                                </a>
  
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a href="{{ url('home') }}" class="btn btn-information">Home</a>
                                    <br>
                                    <a href="{{ url('edit-profile') }}" class="btn btn-information"> Profile</a>
                                    <br>
                                    <a href="{{ url('gallery') }}" class="btn btn-information">Gallery</a>
                                         <br>
                                         <a href="{{ url('Cart-page') }}"  class="btn btn-information">Cart</a>
                                         <br>
                                   
                                    <a href="{{url('chat_page')}}" class="btn btn-information">Chat</a>
                                    <br>
                                    <a href="{{url('see-all-products')}}" class="btn btn-information">Shopping</a>
                                    <br>
                                    <a href="{{url('order_history')}}" class="btn btn-information">Orders</a>
                                    <br>
                                    <a href="{{url('chat_subscription')}}" class="btn btn-information">Chat Plan</a>
                                    <br>
                                    <a href="{{url('question-page')}}" class="btn btn-information"> Test</a>
                                    <br>
                                    <a href="{{url('New-Test')}}" class="btn btn-information"> Test2</a>
                                    <br>
                              
                                    
                                    @if(auth()->user()->role_id==1)
                                    <a href="{{url('products')}}" class="btn btn-information">Product list</a>
                                    <br>
                                    <a href="{{url('plan_list')}}" class="btn btn-information">Subscription Plan</a>
                                    <a href="{{url('list_one_time_plan')}}" class="btn btn-information">One time plan</a>
                                    @endif

                                    <a href="{{route('timer')}}" class="btn btn-information">Timer</a>
                                        <br>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


        <main class="py-4">
            <div class="container">
                   
  @yield('content')
  
        </div>
        </main>
    </div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    setTimeout(function(){
    $('.alert').fadeOut(1000);
    // $('.feedback').hide(1000); // you can also try this
}, 1000);
</script>