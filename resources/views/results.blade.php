@extends('layouts.app')

@section('content')

<div class="container-fluid">

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ Route('home')}}"><span class="oi oi-home"></span></a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ __('app.Results') }}</li>
		</ol>
	</nav>

	<div class="row">
	@if( !$Chapters->isEmpty() )
		@foreach( $Chapters as $C )
			<h2>{{ $C->title }}</h2>

			<ul class="col col-sm-12">

			@foreach( \App\Http\Controllers\ResultsController::getQuestions( $C->id ) as $Q )
			<?php $img = ( $Q->img ) ? '<a href="'. asset($Q->img) .'" target="_new"><img src="'. asset($Q->img) .'" class="img-fluid quizimg"></a>' : ''; ?>	
				<li class="list-group-item list-group-item-action">
					<h5>{{ $Q->id }}. {{ $Q->title }}</h5>
					{!! $img !!}
					@foreach( \App\Http\Controllers\ResultsController::getAnswers( $Q->id ) as $A )
					<?php
						$status = ( $A->correct == True ) ? ' is-valid' : '';
						$answered = ( $A->aid == \App\Http\Controllers\ResultsController::getUserAnswers( $Q->id ) ) ? ' is-invalid' : '';
					?>
					<div class="form-check">
						@php echo \App\Http\Controllers\ResultsController::getUserAnswers( $Q->id ) @endphp
						<input class="form-check-input{{ $status }}" type="radio" id="{{ $A->id }}" name="'. $questionID .'" value="{{ $A->id }}" disabled>
						<label class="form-check-label" for="{{ $A->id }}"> {{ $A->id }} {{ $A->title }}</label>
					</div>
					@endforeach
				</li>
			@endforeach
			</ul>
		@endforeach
	@else
		<p>{{ __('app.NoResultsToShow') }}</p>
	@endif
	</div>
</div>

@endsection