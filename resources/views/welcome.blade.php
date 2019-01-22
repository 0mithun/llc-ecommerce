<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>
        <link href="{{ mix('css/app.css')}}" rel="stylesheet" />
        <link href="{{ mix('css/custom.css')}}" rel="stylesheet" />
    </head>
    <body>
        <h3>LLC Laravel</h3>


        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
