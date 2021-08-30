@extends('layouts.app')

@section('content')

<div class="p-5">
	<div class="container-fluid py-5">
		<h1 class="display-5 fw-bold">{{ __('app.Title') }}</h1>
		<p class="col-md-8 fs-4">{{ __('app.WLC_Description') }}</p>

		@guest
			<div class="row">
				<div class="col col-sm-6 mb-4">
					<p class="fs-4">{{ __('app.WLC_NotAuth') }} <a href="{{ route('register') }}">{{ __('app.Register') }}</a> un/vai <a href="{{ route('login') }}">{{ __('app.Login') }}</a>.</p>
				</div>
			</div>
		@else
		<div class="row">
			<div class="col col-sm-12 mb-4">
				<p>{{ __('app.WLC_auth_as') }}</p>
				<h3 class="mb-3"><span class="oi oi-person"></span> {{ Auth::user()->name }} {{ Auth::user()->surname }}</h3>
				<div class="input-group mb-1">
					<a href="{{ route('results') }}" class="btn btn-primary btn-lg mb-3">{{ __('app.WLC_BTN_ShowResults') }}</a>
				</div>
			</div>
		</div>
		@endguest
	</div>
</div>

@endsection