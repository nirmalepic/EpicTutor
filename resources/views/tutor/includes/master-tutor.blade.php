<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="GeniusOcean Admin Panel.">
    <meta name="author" content="GeniusOcean">
    <link rel="icon" type="image/png" href="{{ asset('public/front/images/favicon.png') }}"> 
    <title>Tutor Panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ URL::asset('public/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('public/assets/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('public/assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('public/assets/css/bootstrap-toggle.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('public/assets/css/bootstrap-tagsinput.css')}}" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/octicons/3.5.0/octicons.min.css" rel="stylesheet">
    <link href="{{ URL::asset('public/assets/css/bootstrap-colorpicker.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ URL::asset('public/assets/css/genius-admin.css')}}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

<div id="wrapper"><!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{!! url('admin/dashboard') !!}">
            <img class="logo" src="{{ asset('public/front/images/logo.png') }}" alt="LOGO">
        </a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">

        <li class="dropdown">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                {{ Auth::user()->fname }} 
                <b class="fa fa-angle-down"></b></a>
            <ul class="dropdown-menu">
                <li><a href="{!! url('tutor/adminprofile') !!}"><i class="fa fa-fw fa-user"></i> Edit Profile</a></li>
                <li><a href="{!! url('tutor/adminpassword') !!}"><i class="fa fa-fw fa-cog"></i> Change Password</a></li>
                <!-- <li class="divider"></li> -->
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="fa fa-fw fa-power-off"></i> Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="{!! url('tutor/dashboard') !!}"><i class="fa fa-fw fa-home"></i> Tutor Dashboard</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-fw fa-cogs"></i> General Settings</a>
            </li>
			<li>
                <a href="{{route('student_list')}}"><i class="fa fa-fw fa-user"></i>Students</a>
            </li>
          
            <li>
                <a href="{!! url('tutor/categories') !!}"><i class="fa fa-fw fa-sitemap"></i>Classes</a>
            </li>                        
            
             <li>
                <a href="{{route('blog_list')}}"><i class="fa fa-fw fa-file-text"></i> Assignment</a>
            </li>
            <li>
                <a href="{!! url('tutor/sliders') !!}"><i class="fa fa-fw fa-photo"></i> Fee Receipt</a>
            </li>
            <li>
                <a href="{!! url('tutor/sliders') !!}"><i class="fa fa-fw fa-photo"></i>Tests</a>
            </li>
            <!-- <li>
                <a href="{!! url('admin/pagesettings') !!}"><i class="fa fa-fw fa-file-code-o"></i> Page Settings</a>
            </li>
            <li>
                <a href="{!! url('admin/language-settings') !!}"><i class="fa fa-fw fa-language"></i> Language Settings</a>
            </li>
            <li>
                <a href="{!! url('admin/testimonial') !!}"><i class="fa fa-fw fa-quote-right"></i> Testimonial Section</a>
            </li>
            <li>
                <a href="{!! url('admin/themecolor') !!}"><i class="fa fa-fw fa-paint-brush"></i> Theme Color Settings</a>
            </li>
            
            <li>
                <a href="{!! url('admin/social') !!}"><i class="fa fa-fw fa-paper-plane"></i> Social Settings</a>
            </li>
            <li>
                <a href="{!! url('admin/tools') !!}"><i class="fa fa-fw fa-wrench"></i> Seo Tools</a>
            </li>
            
            <li>
                <a href="{!! url('admin/subscribers') !!}"><i class="fa fa-fw fa-group"></i> Subscribers</a>
            </li> -->

        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>

@yield('content')

</div><!-- /#wrapper -->
<!-- /#wrapper -->
<script>
    var baseUrl = '{!! url('/') !!}';
</script>
<!-- jQuery -->
<script src="{{ URL::asset('public/assets/js/jquery.min.js')}}"></script>
<script src="{{ URL::asset('public/assets/js/jquery.smooth-scroll.js')}}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ URL::asset('public/assets/js/bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('public/assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ URL::asset('public/assets/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('public/assets/js/bootstrap-tagsinput.js')}}"></script>
<script src="{{ URL::asset('public/assets/js/bootstrap-colorpicker.js')}}"></script>
<!-- Switchery -->
<script src="{{ URL::asset('public/assets/js/bootstrap-toggle.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('public/assets/js/plugin/nicEdit.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('public/assets/js/admin-genius.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('public/assets/js/Chart.min.js')}}">
    
</script>

@yield('footer')
<!-- BEGIN : Footer-->
<!-- <footer class="footer footer-static footer-light">
    <p class="clearfix text-muted text-sm-center px-2">
    <span>Copyright  &copy; 2019 <a href="javascript:void(0)" target="_blank" class="text-bold-800 primary darken-2">EpicTutor </a>, All rights reserved. </span>
    </p>
</footer> -->
<!-- End : Footer-->
</body>
</html>

