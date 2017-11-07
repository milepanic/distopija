<nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ url('/') }}">Vicoteka</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">

        @if(Auth::check())

          <li><a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i></a></li>
          <li><a href="#"><i class="fa fa-bell-o" aria-hidden="true"></i></a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="{{ url('profile/' . Auth::user()->slug) }}">Profile</a></li>

              @if( Auth::user()->admin === 1) <li><a href="{{ url('admin') }}">Admin Panel</a></li> @endif

              <li><a href="{{ url('submit') }}">Post Joke</a></li>
              <li><a href="{{ url('create') }}">Create Category</a></li>

              <li role="separator" class="divider"></li>
              <li>
              	<a href="{{ route('logout') }}" 
                  onclick="event.preventDefault(); 
                  document.getElementById('logout-form').submit();">
                      Logout
                  </a>
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" 
                  method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
              </li>
              
            </ul>
          </li>

          @else

            <li><a href="{{ url('register') }}">Register</a></li>
            <li><a href="{{ url('login') }}">Login</a></li>

          @endif
      </ul>
    </div>
  </div>
</nav>