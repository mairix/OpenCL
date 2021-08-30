<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
	<div class="container-fluid">
		<a class="navbar-brand" href="{{ url('/') }}">{{ __('app.Title') }}</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
			@guest
				@if (Route::has('login'))
				<li class="nav-item">
					<a class="nav-link" href="{{ route('login') }}"><span class="oi oi-account-login"></span> {{ __('app.Login') }}</a>
				</li>
				@endif
				@if (Route::has('register'))
				<li class="nav-item">
					<a class="nav-link" href="{{ route('register') }}"><span class="oi oi-plus"></span> {{ __('app.Register') }}</a>
				</li>
				@endif
			@else
				<li class="nav-item"><a class="nav-link" href="{{ route('home') }}"><span class="oi oi-home"></span> {{ __('app.Home') }}</a></li>
				<li class="nav-item"><a class="nav-link" href="{{ route('results') }}"><span class="oi oi-bar-chart"></span> {{ __('app.Results') }}</a></li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						<span class="oi oi-person"></span> {{ Auth::user()->name }} {{ Auth::user()->surname }}
					</a>
					<ul class="dropdown-menu dropdown-menu-lg-end pt-0 pb-0" aria-labelledby="navbarDropdown">
						@if (Auth::user()->group == 'administrator')
						<a class="dropdown-item" href="{{ route('chapters') }}"><span class="oi oi-book"></span> {{ __('app.Chapters') }}</a>
						<a class="dropdown-item" href="{{ route('questions') }}"><span class="oi oi-question-mark"></span> {{ __('app.Questions') }}</a>
						<a class="dropdown-item" href="{{ route('users') }}" ><span class="oi oi-people"></span> {{ __('app.Users') }}</a>
						@endif
						<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span class="oi oi-account-logout"></span> {{ __('app.Logout') }}
						</a>

						<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
						    @csrf
						</form>
					</ul>
				</li>
				@endguest
			</ul>
		</div>
	</div>
</nav>