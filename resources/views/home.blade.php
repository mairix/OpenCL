@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('app.Dashboard') }}</div>

                <div class="card-body">
                    <div class="list-group">
                    @foreach ( $Chapters as $Chapter )
                    <a href="{{ route('chapters.show', $Chapter->id) }}" class="list-group-item list-group-item-action">{{ $Chapter->title }}</a>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
