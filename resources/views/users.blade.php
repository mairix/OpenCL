@extends('layouts.app')

@section('content')

<div class="container-fluid">

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ Route('home')}}"><span class="oi oi-home"></span></a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ __('app.Users') }}</li>
		</ol>
	</nav>

	<div class="row">
		<div class="col col-sm-12">
			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col"></th>
						<th scope="col">{{ __('app.prf_group') }}</th>
						<th scope="col">{{ __('app.prf_name') }}</th>
						<th scope="col">{{ __('app.prf_surname') }}</th>
						<th scope="col">{{ __('app.prf_email') }}</th>
						<th scope="col">{{ __('app.prf_progres') }}</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
				@foreach($Users as $user)
					@if ( $user->group == 'administrator' )
					<tr class="row_administrator">
					@elseif ( $user->trashed() )
					<tr class="row_disabledUser">
					@else
					<tr>
					@endif
						<th scope="row">{{ ( $Users->currentpage() - 1 ) * $Users->perpage() + $loop->index + 1 }}</th>
						<td>{{ __('app.UserGroup_'.$user->group ) }}</td>
						<td>{{ $user->name }}</td>
						<td>{{ $user->surname }}</td>
						<td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
						<td>
							@if( $user->progress != NULL )
							@php $progressPerc = \App\Http\Controllers\UsersController::progress( $user->id ) @endphp
							<div class="progress">
								<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{ $progressPerc }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $progressPerc }}%">{{ $user->progress }}</div>
							</div>
							@endif
						</td>
						<td>
						@if ( $user->group != 'administrator' )
							@if ( $user->trashed() )
							<form action="{{ route('users.restore', $user->id ) }}" method="POST">
								@csrf
								<button type="submit" class="btn btn-light btn-sm" title="{{ __('app.BTN_Restore') }}"><span class="oi oi-action-undo"></span></button>
								<small>{{ $user->deleted_at }}</small>
							</form>
							@else
							<form action="{{ route('users.delete', $user->id ) }}" method="POST">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-light btn-sm" title="{{ __('app.BTN_Del') }}"><span class="oi oi-x"></span></button>
							</form>
							@endif
						@endif
						</td>
					</tr>
				@endforeach
				</tbody>
				<tfoot>
					@if( $Users->hasPages() )
					<tr>
						<th colspan="6">{{ $Users->links() }}</th>
					</tr>
					@endif
				</tfoot>
			</table>
		</div>
	</div>
</div>

@endsection