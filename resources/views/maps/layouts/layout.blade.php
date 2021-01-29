<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $title }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Roboto+Slab&display=swap" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset(config('settings.theme')) }}/css/style.css" rel="stylesheet">

        <script type="text/javascript" src="{{ asset(config('settings.theme')) }}/js/jquery.js"></script>
        <script src="{{ asset(config('settings.theme')) }}/js/bootstrap-filestyle.min.js"></script>
        <script type="text/javascript" src="{{ asset(config('settings.theme')) }}/js/jquery-ui.js"></script>
        
        
        @yield('scripts')
        
    </head>
    <body>
        <div class="page">

            <div class="navigation">
                @yield('navigation')
            </div>

            @if (count($errors) > 0)
                <div class="box error-box">
                    
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
            
                </div>
			@endif
				
            @if (session('error'))
                <div class="box error-box">
                    {{ session('error') }}
                </div>
            @endif

            <div class="content" >
                @yield('content')
            </div>
            
        </div>
    </body>

</html>
