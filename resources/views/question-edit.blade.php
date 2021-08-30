@extends('layouts.app')

@section('content')

<div class="container-fluid">

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ Route('home')}}"><span class="oi oi-home"></span></a></li>
			<li class="breadcrumb-item"><a href="{{ Route('questions')}}">{{ __('app.Questions') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ $Question->title }}</li>
		</ol>
	</nav>

	<div class="row">
		<div class="col col-sm-12">
			<h1>{{ $Question->title }}</h1>

			<div class="input-group mb-3">
				<select name="" class="form-control" title="{{ __('app.Q_Chapter') }}">
					@foreach( $Chapters as $C )
					<option value="{{ $C->id }}"@if( $C->id == $Question->chapter) selected @endif>{{ $C->title }}</option>
					@endforeach
				</select>
				<input type="text" class="form-control" name="QuestionTitle" value="{{ $Question->title }}" placeholder="{{ __('app.Q_Title') }}">
				<input type="text" class="form-control" name="QuestionTitle" value="{{ $Question->img }}" placeholder="{{ __('app.Q_Image') }}">
			</div>
			<hr>
			@foreach( $Answers as $A )
			<div class="input-group mb-3">
				<div class="input-group-text" title="{{ __('app.Q_CorrectAnswer') }}">
					<input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input"@if($A->correct == true)checked @endif placeholder="{{ __('app.Q_Answer') }}">
				</div>
				<input type="text" class="form-control" value="{{ $A->title }}" placeholder="{{ __('app.Q_Answer') }}">
			</div>
			@endforeach
			<hr>
			<div class="input-group mb-3">
				<div class="input-group-text" title="{{ __('app.Q_CorrectAnswer') }}">
					<input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
				</div>
				<input type="text" class="form-control" placeholder="{{ __('app.Q_Answer') }}">
				<div class="input-group-text" title="{{ __('app.Q_CorrectAnswer') }}">
					<button class="btn btn-light btn-sm" id="AnswerPlus"><span class="oi oi-plus"></span></button>
				</div>
			</div>

			<div class="input-group mb-3">
				<form action="">
					@csrf
					<button class="btn btn-primary" id="AnswerPlus">{{ __('app.BTN_Save') }}</button>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection