<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Startmin Admin Panel</title>

        <!-- Bootstrap Core CSS -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="{{ asset('css/timeline.css') }}" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="{{ asset('css/startmin.css') }}" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="{{ asset('css/morris.css') }}" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

        <!-- DataTable CSS CDN -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">

        <!-- Font Awesome -->
        <script src="https://use.fontawesome.com/94a3cab706.js"></script>

        <!-- DataTables CSS -->
        <link href="{{ asset('css/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet">
        {{-- DataTables Responsive CSS --}}
        <link href="{{ asset('css/dataTables/dataTables.responsive.css') }}" rel="stylesheet">
    </head>
    <body>

        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand" href="http://secondtruth.github.io/startmin/pages/index.html">Startmin</a>
                </div>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <ul class="nav navbar-nav navbar-left navbar-top-links">
                    <li><a href="/"><i class="fa fa-home fa-fw"></i> Website</a></li>
                </ul>

                <ul class="nav navbar-right navbar-top-links">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> {{ Auth::user()->name }} <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ route('logout') }}" 
                                onclick="event.preventDefault(); 
                                document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out fa-fw"></i> Logout</a>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" 
                                method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                                        
                        </ul>
                    </li>
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li>
                                <a href="{{ url('admin') }}" class="{{ Request::is('admin') ? 'active' : '' }}">
                                    <i class="fa fa-dashboard fa-fw"></i> Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('admin/users') }}" class="{{ Request::is('admin/users') ? 'active' : '' }}">
                                    <i class="fa fa-users fa-fw"></i> Users
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('admin/posts') }}" class="{{ Request::is('admin/posts') ? 'active' : '' }}">
                                    <i class="fa fa-pencil fa-fw"></i> Posts
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('admin/categories') }}" class="{{ Request::is('admin/categories') ? 'active' : '' }}">
                                    <i class="fa fa-archive fa-fw"></i> Categories
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('admin/medals') }}" class="{{ Request::is('admin/medals') ? 'active' : '' }}">
                                    <i class="fa fa-circle-o-notch fa-fw"></i> Medals
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"> {{ Route::currentRouteName() }} </h1>
                    </div>
                </div>
                <div class="row">


                    @yield('content')


                </div>
            </div>
        </div>

        <!-- JQuery CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
        <!-- DataTables JavaScript -->
        <script src="{{ asset('js/dataTables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('js/dataTables/dataTables.bootstrap.min.js') }}"></script>
        <script>
            $(document).ready(function(){
                $('#dataTable').DataTable();
            });
        </script>

        <!-- Bootstrap Core JavaScript -->
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>

        <!-- Morris Charts JavaScript -->
        <script src="{{ asset('js/raphael.min.js') }}"></script>
        <script src="{{ asset('js/morris.min.js') }}"></script>
        <script src="{{ asset('js/morris-data.js') }}"></script>

        <!-- Custom Theme JavaScript -->
        <script src="{{ asset('js/startmin.js') }}"></script>

    </body>
</html>