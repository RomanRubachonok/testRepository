<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link href="/css/app.css" rel="stylesheet" type="text/css">
</head>
<body>

    <section class="content">
        @yield('content')
    </secation>

    <script src="/js/app.js" type="text/javascript"></script>
</body>
</html>
