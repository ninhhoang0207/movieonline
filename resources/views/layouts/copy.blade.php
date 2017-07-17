<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="http://localhost/movie/public/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/movie/public/css/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/movie/public/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/movie/public/css/style.css">
    <script type="text/javascript" src="http://localhost/movie/public/js/jquery.min.js"></script>
    <script type="text/javascript" src="http://localhost/movie/public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://localhost/movie/public/js/moment.min.js"></script>
    <script type="text/javascript" src="http://localhost/movie/public/js/daterangepicker.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/> 
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
    <!-- ckeditor -->
    <script type="text/javascript" src="http://localhost/movie/public/js/ckeditor.js"></script>
    <script type="text/javascript" src="http://localhost/movie/public/js/ckfinder/ckfinder.js"></script>
    <script type="text/javascript" src="http://localhost/movie/public/js/config.js"></script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <!-- <link href="/css/app.css" rel="stylesheet"> -->

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Đăng nhập</a></li>
                            <li><a href="{{ url('/register') }}">Đăng ký</a></li>
                        @elseif(Auth::user()->role != 1)
                             
                              <div class="container">
                                <div class="navbar-header">
                                <!--Khi responsive-->
                                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>

                                  </button>
                                  <!--chế độ deskop-->
                                  <a class="navbar-brand active" href="http://localhost/movie/hethong">QUẢN TRỊ HỆ THỐNG</a>
                                </div>
                                <div id="navbar" class="navbar-collapse collapse">
                                  <ul class="nav navbar-nav">
                                    <li><a href="{{ url('http://localhost/movie') }}" target="_blank">Trang chủ</a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                            {{ Auth::user()->username }} <span class="caret"></span>
                                        </a>

                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="{{ url('/logout') }}"
                                                    onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                    Logout
                                                </a>

                                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            
                        @else
                            <nav class="navbar navbar-default navbar-static-top">
                              <div class="container">
                                <div class="navbar-header">
                                <!--Khi responsive-->
                                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>

                                  </button>
                                  <!--chế độ deskop-->
                                  <a class="navbar-brand active" href="http://localhost/movie/hethong">QUẢN TRỊ HỆ THỐNG</a>
                                </div>
                                <div id="navbar" class="navbar-collapse collapse">
                                  <ul class="nav navbar-nav">
                                    <li><a href="http://localhost/movie/" target="_blank">Trang chủ</a></li>
                                    <li class="dropdown">
                                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Quản lý phim <span class="caret"></span></a>
                                      <ul class="dropdown-menu">
                                        <li><a href="http://localhost/movie/hethong/phim/danh-sach">Danh sách phim</a></li>
                                        <li><a href="http://localhost/movie/hethong/phim/upload">Tải phim lên</a></li>
                                        <li><a href="http://localhost/movie/hethong/phim/hang-muc">Hạng mục phim</a></li>
                                      </ul>
                                    </li>
                                    <li class="dropdown">
                                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Quản lý diễn viên <span class="caret"></span></a>
                                      <ul class="dropdown-menu">
                                        <li><a href="http://localhost/movie/hethong/dien-vien/danh-sach">Danh sách diễn viên</a></li>
                                        <li><a href="http://localhost/movie/hethong/dien-vien/them">Thêm diễn viên</a></li>
                                      </ul>
                                    </li>
                                    <li class="dropdown">
                                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Quản lý tin tức <span class="caret"></span></a>
                                      <ul class="dropdown-menu">
                                        <li><a href="http://localhost/movie/hethong/tin-tuc/danh-sach">Danh sách tin tức</a></li>
                                        <li><a href="http://localhost/movie/hethong/tin-tuc/them">Đăng tin tức mới</a></li>
                                      </ul>
                                    </li>
                                     <li><a href="">Thống kê</a></li>
                                     <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                          {{ Auth::user()->username }} <span class="caret"></span>
                                        </a>

                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="{{ url('/logout') }}"
                                                    onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                    Logout
                                                </a>

                                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                  </ul>
                                </div><!--/.nav-collapse -->
                              </div>
                            </nav>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
             @if (Session::has('responseData'))
                @if (Session::get('responseData')['statusCode'] == 1)
                    <div class="alert alert-success">{{ Session::get('responseData')['message'] }}</div>
                @elseif (Session::get('responseData')['statusCode'] == 2)
                    <div class="alert alert-danger">{{ Session::get('responseData')['message'] }}</div>
                @endif
            @endif
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <!-- <script src="/js/app.js"></script> -->
</body>
</html>
