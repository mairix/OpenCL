@extends('layouts.app')

@section('content')

<div class="container-fluid">

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ Route('home')}}"><span class="oi oi-home"></span></a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ __('app.Chapters') }}</li>
		</ol>
	</nav>

	<div class="row">
		<div class="col col-sm-4">
			<form action="{{ route('chapters.store') }}" method="POST">
				@csrf

				<div class="row">
					<div class="col col-sm-12 mb-3">
						<div class="input-group">
							<input type="text" name="title" class="form-control" placeholder="{{ __('app.CHP_Title') }}" aria-label="title" required>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col col-sm-12 mb-3">
						<div class="input-group">
							<span class="input-group-text"><span class="oi oi-image"></span></span>
							<input type="text" name="thumb" class="form-control" placeholder="{{ __('app.CHP_Thumb') }}" aria-describedby="thumbHelp" required>
						</div>
						<div id="thumbHelp" class="form-text">{{ __('app.CHP_ThumbHelp') }}</div>
					</div>
				</div>

				<div class="row">
					<div class="col col-sm-12 mb-3">
						<div class="input-group">
							<span class="input-group-text" id="video"><span class="oi oi-video"></span></span>
							<input type="text" name="video" class="form-control" placeholder="{{ __('app.CHP_Video') }}" aria-label="video" aria-describedby="video" required>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col col-sm-12 mb-3">
						<div class="input-group">
							<textarea name="body" class="form-control" id="summernote" cols="30" rows="10" placeholder="{{ __('app.CHP_Body') }}"></textarea>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col col-sm-12 mb-3">
						<button type="submit" class="btn btn-primary">{{ __('app.BTN_Add') }}</button>
					</div>
				</div>
			</form>
		</div>
		<div class="col col-sm-8">
			<table class="table table-hover">
				<thead>
					<tr>
						<th></th>
						<th>{{ __('app.CHP_Public') }}</th>
						<th>{{ __('app.CHP_Order') }}</th>
						<th>{{ __('app.CHP_Title') }}</th>
						<th>{{ __('app.CHP_Thumb') }}</th>
						<th>{{ __('app.CHP_Video') }}</th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach ( $Chapters as $Chapter )
					<tr>
						<td>{{ $Chapter->order }}</td>
						<td>{{ __('app.CHP_Public_'.$Chapter->public ) }}</td>
						<td>
							<form action="{{ route('chapters.order') }}" method="POST">
								@csrf
								<input type="number" class="form-control chapterOrder" id="{{ $Chapter->id }}" name="chapterOrder[{{ $Chapter->id }}]" value="{{ $Chapter->order }}" size="2" min="1">
							</form>
						</td>
						<td>{{ $Chapter->title }}</td>
						<td>{{ $Chapter->thumb }}</td>
						<td>{{ $Chapter->video }}</td>
						<td>
							<a href="{{ route('chapters.edit', $Chapter->id ) }}" class="btn btn-light btn-sm" title="{{ __('app.BTN_Edit') }}"><span class="oi oi-pencil"></span></a>
						</td>
						<td>
						@if( $Chapter->public == True )
							<a href="{{ route('chapters.unpublish', $Chapter->id ) }}" class="btn btn-light btn-sm" title="{{ __('app.BTN_Unpublish') }}"><span class="oi oi-lock-unlocked"></span></a>
						@else
							<a href="{{ route('chapters.publish', $Chapter->id ) }}" class="btn btn-light btn-sm" title="{{ __('app.BTN_Publish') }}"><span class="oi oi-lock-locked"></span></a>
						@endif
						</td>
						<td>
							<form action="{{ route('chapters.delete', $Chapter->id ) }}" method="POST">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-light btn-sm" title="{{ __('app.BTN_Delete') }}"><span class="oi oi-x"></span></button>
							</form>
						</td>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					@if( $Chapters->hasPages() )
					<tr>
						<td colspan="9">{{ $Chapters->links() }}</td>
					</tr>
					@endif
				</tfoot>
			</table>
		</div>
	</div>
</div>

@endsection