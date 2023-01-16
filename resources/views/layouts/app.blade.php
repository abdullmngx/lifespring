
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Maestro">
    <link rel="icon" href="/logo.png" type="image/x-icon" sizes="48x48">
    <link rel="shortcut icon" href="/logo.png" type="image/x-icon" sizes="48x48">
    <title>{{ env('APP_NAME') }} - @yield('title')</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="/assets/css/fontawesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="/assets/css/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="/assets/css/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="/assets/css/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="/assets/css/feather-icon.css">

    <link rel="stylesheet" type="text/css" href="/assets/css/sweetalert2.css">
    @yield('css-links')
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <link id="color" rel="stylesheet" href="/assets/css/color-2.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="/assets/css/responsive.css">

  </head>
  <body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="theme-loader">    
        <div class="loader-p"></div>
      </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      <div class="page-main-header">
        <div class="main-header-right row m-0">
          <div class="main-header-left">
            <div class="logo-wrapper"><a href="/staff/dashboard"><img class="img-fluid" width="40" src="/logo.png" alt=""> <span class="text-info">Life<span class="text-warning">Spring</span></span></a></div>
            <div class="dark-logo-wrapper"><a href="/staff/dashboard"><img class="img-fluid" width="40" src="/logo.png" alt=""> <span class="text-info">Life<span class="text-warning">Spring</span></span></a></div>
            <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle"></i></div>
          </div>
          <div class="left-menu-header col">
            <ul>
              <li>
                
              </li>
            </ul>
          </div>
          <div class="nav-right col pull-right right-menu p-0">
            <ul class="nav-menus">
              <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
              <li>
                <div class="mode"><i class="fa fa-moon-o dark-toggle"></i></div>
              </li>
              <li class="onhover-dropdown p-0">
                <button class="btn btn-primary-light" type="button"><a href="/staff/logout"><i data-feather="log-out"></i>Log out</a></button>
              </li>
            </ul>
          </div>
          <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
        </div>
      </div>
      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper horizontal-menu">
        <!-- Page Sidebar Start-->
        <header class="main-nav">
          <div class="sidebar-user text-center"><a class="setting-primary" href="javascript:void(0)"><i data-feather="settings"></i></a><img class="img-90 rounded-circle" src="/storage/{{ auth('staff')->user()->passport }}" width="100" height="100" alt="">
            <div class="badge-bottom"></div><a href="#">
              <h6 class="mt-3 f-14 f-w-600">{{ ucwords(str_replace('_', ' ', auth('staff')->user()->role)) }}</h6></a>
            <p class="mb-0 font-roboto">{{ auth('staff')->user()->name }}</p>
          </div>
          <nav>
            <div class="main-navbar">
              <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
              <div id="mainnav">           
                @include('partials.sidemenus')
              </div>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </div>
          </nav>
        </header>
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-sm-6">
                  <h3>@yield('title')</h3>
                  @if (!request()->routeIs('staff.dashboard'))
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/staff/dashboard">Home</a></li>
                    @yield('breadcrumb-main')
                    <li class="breadcrumb-item active">@yield('title')</li>
                  </ol>
                  @endif
                </div>
              </div>
            </div>
          </div>
          @yield('content')
        </div>
        <!-- footer start-->
        <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 footer-copyright">
                <p class="mb-0">Copyright <script>document.write(new Date().getFullYear())</script> © {{ env('APP_NAME') }} All rights reserved.</p>
              </div>
              <div class="col-md-6">
                <p class="pull-right mb-0"></p>
              </div>
            </div>
          </div>
        </footer>

        @yield('modals')
      </div>
    </div>
    <!-- latest jquery-->
    <script src="/assets/js/jquery-3.5.1.min.js"></script>
    <!-- feather icon js-->
    <script src="/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="/assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- Sidebar jquery-->
    <script src="/assets/js/sidebar-menu.js"></script>
    <script src="/assets/js/config.js"></script>
    <!-- Bootstrap js-->
    <script src="/assets/js/bootstrap/popper.min.js"></script>
    <script src="/assets/js/bootstrap/bootstrap.min.js"></script>
    <!-- Plugins JS start-->
    <script src="/assets/js/sweet-alert/sweetalert.min.js"></script>
    <script src="/assets/js/chart/apex-chart/moment.min.js"></script>
    <script src="/assets/js/chart/apex-chart/apex-chart.js"></script>
    <script src="/assets/js/chart/apex-chart/stock-prices.js"></script>
    @yield('script-src')
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="/assets/js/script.js"></script>
    <script>
      if (sessionStorage.getItem('theme'))
      {
        $('body').addClass(sessionStorage.getItem('theme'))
        if (sessionStorage.getItem('theme') == "dark-only")
        {
          document.querySelector('div.mode i').classList.remove('fa-moon-o')
          document.querySelector('div.mode i').classList.add('fa-lightbulb-o')
        }
      }
      $('.dark-toggle').click(function() {
        if (sessionStorage.getItem('theme'))
        {
          if (sessionStorage.getItem('theme') == "light-only")
          {
            sessionStorage.setItem('theme', 'dark-only')
          }else
          {
            sessionStorage.setItem('theme', 'light-only')
          }
        }else
        {
          sessionStorage.setItem('theme', 'dark-only')
        }
      })
    </script>
    @yield('scripts')
    <!-- login js-->
    <!-- Plugin used-->
  </body>
</html>