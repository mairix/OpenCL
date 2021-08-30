@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('app.verifyemail') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('app.verifyemailsent') }}
                        </div>
                    @endif

                    {{ __('app.verifyemailbefore') }}
                    {{ __('app.verifyemailnot') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('app.verifyemaillink') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
