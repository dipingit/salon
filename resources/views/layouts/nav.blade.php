<!-- Navbar -->
<nav class="main-header navbar navbar-expand bg-dark navbar-dark border-bottom">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
		</li>
	</ul>

	<!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">
		<img src="{{ asset('images/users/'.Auth::user()->image) }}" class="avatar">
      	<li class="nav-item dropdown notification">
	        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          {{ Auth::user()->name }}
	        </a>
	        <div class="dropdown-menu bg-dark usl" aria-labelledby="navbarDropdown">
	          	<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>

	          	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	            {{ csrf_field() }}
	          	</form>
	          	<a class="dropdown-item" href="{{ url('/changePassword') }}">
	            	Change Password
	          	</a>
	        </div>
      	</li>
	</ul>
</nav>
<!-- /.navbar -->