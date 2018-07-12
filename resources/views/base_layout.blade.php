<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SintegrEs</title>

        {{-- Scripts --}}
        <script type="text/javascript">
            var APP_URL = {!! json_encode(url('/')) !!}
        </script>
        {!! Html::script('js/jquery-3.3.1.min.js') !!}
        {!! Html::script('js/jquery.mask.min.js') !!}
        {!! Html::script('js/bootstrap.min.js') !!}
        {!! Html::script('js/utils.js') !!}

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/bootstrap.min.css') }}" media="all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/sintegres.css') }}" media="all" rel="stylesheet" type="text/css" />
    </head>
    <body>
        @include('nav')
        <div class="container">
            @yield('content')
        </div>
    </body>
    <footer id="page_footer">
        <script type="text/javascript">
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        @yield('footer')
    </footer>
</html>
