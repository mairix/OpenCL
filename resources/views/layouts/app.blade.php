<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ __('app.Title') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/open-iconic-bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/summernote.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">

            <x-menu/>

            <main class="py-4">
                @yield('content')
            </main>
        </div>

        <footer class="p-4">
            <p class="text-center">{!! __('app.Copyright') !!}</p>
        </footer>

        @if ( \Route::current()->getName() == 'chapters_qqq' )
        <script src="{{ asset('js/summernote.min.js') }}"></script>
        <script type="javascript">
            $(function() {

                // WYSIWYG Editor
                $('#summernote').summernote({
                    toolbar: [
                        ['align', ['paragraph']],
                        ['style', ['bold', 'italic', 'underline']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol']],
                        ['insert', ['link']],
                    ]
                });

            });
        </script>
        @endif

    </body>
</html>
