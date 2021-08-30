@extends('layouts.app')

@section('content')
<div class="container-fluid">

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ Route('home')}}"><span class="oi oi-home"></span></a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ $Chapter->title }}</li>
		</ol>
	</nav>

	<div class="modal fade" id="quizModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="quizModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="quizModalLabel">{{ $Chapter->title }}</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="{{ route('answers.store') }}" method="POST">
					@csrf
				<div class="modal-body">
				@foreach( \App\Http\Controllers\chaptersController::getQuestions( $Chapter->id ) as $Q )
				<?php $img = ( $Q->img ) ? '<img src="'. asset($Q->img) .'" class="img-fluid quizimg">' : ''; ?>	
					<li class="list-group-item list-group-item-action">
						<h5>{{ $Q->id }}. {{ $Q->title }}</h5>
						{!! $img !!}
						@foreach( \App\Http\Controllers\chaptersController::getAnswers( $Q->id ) as $A )
						<div class="form-check">
							<input class="form-check-input" type="radio" id="q-{{ $A->id }}" name="answer[{{ $Q->id }}]" value="{{ $A->id }}" required>
							<label class="form-check-label" for="q-{{ $A->id }}">{{ $A->title }}</label>
						</div>
						@endforeach
					</li>
				@endforeach
				</div>
				<div class="modal-footer">
					<input type="hidden" name="chapter" value="{{ $Chapter->order }}">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('app.BTN_Close') }}</button>
					<button type="submit" class="btn btn-primary">{{ __('app.BTN_SaveAnswers') }}</button>
				</div>
				</form>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<h1>{{ $Chapter->title }}</h1>
		<p>{{ $Chapter->body }}</p>
		<video class="video" id="video" poster="{{ asset( 'src/'. $Chapter->thumb ) }}" preload controls>
			<source src="{{ asset( 'src/'. $Chapter->video ) }}" type="video/mp4">
		</video>
		<hr class="mt-4 mb-4">
		@if( Auth::user()->progress < $Chapter->order )
		<button type="button" id="openQuiz" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#quizModal">{{ __('app.BTN_TakeTest') }}</button>
		@endif
	</div>
</div>

@endsection