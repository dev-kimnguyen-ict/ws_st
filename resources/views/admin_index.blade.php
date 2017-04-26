<!doctype html>
<html lang="{{config('app.locale')}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}}</title>
    <link rel="stylesheet" href="{{mix('css/admin.app.css', 'builds')}}">
    <script>
        window.WS = {!! json_encode(['csrfToken' => csrf_token()]) !!}
    </script>
</head>
<body>
<div id="app">
    Loading...
</div>

<script src="{{ mix('js/manifest.js', 'builds') }}"></script>
<script src="{{ mix('js/vendor.js', 'builds') }}"></script>
<script src="{{mix('js/admin.app.js', 'builds')}}"></script>
</body>
</html>
