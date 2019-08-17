<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin CMS! | </title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="{{asset('template/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('template/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('template/css/nprogress.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('template/css/custom.min.css')}}" rel="stylesheet">
    <script src="{{asset('template/js/jquery.min.js')}}"></script>
    
    @yield('style')
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col" style="position: fixed;">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Admin CMS!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="Profile" class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Auth::user()->name }}</h2>
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.html">Dashboard</a></li>
                      <li><a href="index2.html">Dashboard2</a></li>
                      <li><a href="index3.html">Dashboard3</a></li>
                    </ul>
                  </li>
                  @if(request()->user()->role == 'admin')
                      <li><a><i class="fas fa-users"></i> User Managenent<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="{{route('vendor.index')}}">Vendor Management</a></li>
                          <li><a href="{{route('adminuser.index')}}">User Management</a></li>
                        </ul>
                      </li>
                      <li><a><i class="far fa-comments"></i> Review Managenent<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="{{route('hotelreview.index')}}">Hotel Reviews</a></li>
                          <li><a href="{{route('activityreview.index')}}">Activity Reviews</a></li>
                        </ul>
                      </li>
                      <li><a href="{{route('banner.index')}}">Banner Management</a></li>
                      <li><a href="{{route('city.index')}}">City Management</a></li>
                      <li><a href="{{route('activitycategory.index')}}">Activity Categories</a></li>
                      <li><a><i class="fas fa-layer-group"></i> Product Managenent<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="{{route('adminhotel.index')}}">Hotel Management</a></li>
                          <li><a href="{{route('adminroom.index')}}">Room Management</a></li>
                          <li><a href="{{route('adminactivity.index')}}">Activity Management</a></li>
                        </ul>
                      </li>
                      <li><a><i class="fas fa-shopping-cart"></i> Booking Managenent<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="{{route('roombooking.index')}}">Room Booking</a></li>
                          <li><a href="#">Activity Booking</a></li>
                        </ul>
                      </li>
                    @endif
                    @if(request()->user()->role == 'vendor')
                      <li><a href="{{route('hotel.index')}}">Hotel Management</a></li>
                      <li><a href="{{route('room.index')}}">Room Management</a></li>
                      <li><a href="{{route('activities.index')}}">Activities Management</a></li>
                      <li><a href="{{route('vendororder.index')}}">Order Management</a></li>
                    @endif
                    @if(request()->user()->role == 'user')
                      <li><a href="{{route('vendororder.index')}}">Order Management</a></li>
                    @endif  
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/img.jpg" alt="Profile">{{Auth::user()->name}}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li><a href="login.html" class="dropdown-item" onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                     <form id="logout-form" method="POST" action="{{route('logout')}}" style="display: none;">
                       @csrf
                     </form>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          @yield('content')
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    
    <!-- jQuery -->
    <!-- Bootstrap -->
    <script src="{{asset('template/js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('template/js/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{asset('template/js/nprogress.js')}}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{asset('template/js/custom.js')}}"></script>
    @yield('script')
  </body>
</html>
