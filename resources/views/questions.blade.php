@extends('layouts.app')

@section('content')

<div class="container-fluid">

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ Route('home')}}"><span class="oi oi-home"></span></a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ __('app.Questions') }}</li>
		</ol>
	</nav>

	<div class="row">
		<div class="col col-sm-12">
			<table class="table table-hover">
				<thead>
					<th scope="col">#</th>
					<th scope="col">ID</th>
					<th scope="col">{{ __('app.Q_Image') }}</th>
					<th scope="col">{{ __('app.Q_Question') }}</th>
					<th scope="col">{{ __('app.Q_Section') }}</th>
					<th scope="col"></th>
				</thead>
				<tbody>
					@foreach( $Questions as $Q )
					<tr>
						<td>{{ ( $Questions->currentpage() - 1 ) * $Questions->perpage() + $loop->index + 1 }}</td>
						<td>{{ $Q->id }}</td>
						<td>
						@if( $Q->img )
						<a href="{{ $Q->img }}" target="_blank"><span class="oi oi-image"></span></a>
						@endif
						</td>
						<td>{{ $Q->title }}</td>
						<td>{{ $Q->chapter }}</td>
						<td>
							<a href="{{ Route('questions.show', $Q->id ) }}" class="btn btn-light btn-sm" title="{{ __('app.BTN_Edit') }}">
								<span class="oi oi-pencil"></span>
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					@if( $Questions->hasPages() )
					<tr>
						<th colspan="6">{{ $Questions->links() }}</th>
					</tr>
					@endif
				</tfoot>
			</table>
		</div>
	</div>
</div>

@endsection